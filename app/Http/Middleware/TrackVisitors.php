<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    private const VISITOR_STATS_CACHE_KEY = 'frontend_visitor_stats';

    private const GEO_CACHE_TTL_SECONDS = 86400; // 24 hours

    /**
     * Only track frontend page requests — skip admin dashboard, API,
     * AJAX calls, asset requests, and bot-like user agents.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldTrack($request, $response)) {
            return $response;
        }

        try {
            if (! Schema::hasTable('visitor_logs')) {
                return $response;
            }

            $sessionId = $this->resolveSessionId($request);
            $ip        = $this->resolveClientIp($request);
            $url       = $request->fullUrl();
            $now       = now();

            $isNewSession = $this->persistVisit($sessionId, $ip, $url, $now);

            if ($isNewSession) {
                Cache::forget(self::VISITOR_STATS_CACHE_KEY);
                $this->deferGeoLookup($sessionId, $ip);
            }

            if (random_int(1, 100) === 1) {
                DB::table('visitor_logs')
                    ->where('last_activity', '<', now()->subHours(48))
                    ->delete();
            }
        } catch (\Throwable $e) {
            Log::warning('TrackVisitors middleware error: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * Atomic visit write: row upsert + lifetime counter increment only on true insert.
     */
    private function persistVisit(string $sessionId, string $ip, string $url, $now): bool
    {
        return (bool) DB::transaction(function () use ($sessionId, $ip, $url, $now) {
            $existing = DB::table('visitor_logs')
                ->where('session_id', $sessionId)
                ->lockForUpdate()
                ->first();

            if ($existing) {
                DB::table('visitor_logs')
                    ->where('session_id', $sessionId)
                    ->update([
                        'ip_address'    => $ip,
                        'url_visited'   => $url,
                        'last_activity' => $now,
                        'updated_at'    => $now,
                    ]);

                return false;
            }

            DB::table('visitor_logs')->insert([
                'session_id'    => $sessionId,
                'ip_address'    => $ip,
                'url_visited'   => $url,
                'last_activity' => $now,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            if (Schema::hasTable('site_settings')) {
                DB::table('site_settings')
                    ->where('key', 'total_lifetime_visitors')
                    ->increment('value');
            }

            return true;
        });
    }

    /**
     * Run geo resolution after the HTTP response is sent (never blocks TTFB).
     */
    private function deferGeoLookup(string $sessionId, string $ip): void
    {
        app()->terminating(function () use ($sessionId, $ip) {
            $this->applyGeoToVisitorLog($sessionId, $ip);
        });
    }

    private function applyGeoToVisitorLog(string $sessionId, string $ip): void
    {
        try {
            if (! Schema::hasTable('visitor_logs')) {
                return;
            }

            $geoData = $this->resolveLocationCached($ip);

            if (! $geoData) {
                return;
            }

            DB::table('visitor_logs')
                ->where('session_id', $sessionId)
                ->update([
                    'country'   => $geoData['country'],
                    'region'    => $geoData['region'],
                    'city'      => $geoData['city'],
                    'latitude'  => $geoData['latitude'],
                    'longitude' => $geoData['longitude'],
                ]);
        } catch (\Throwable $e) {
            Log::debug('TrackVisitors deferred geo failed for ' . $ip . ': ' . $e->getMessage());
        }
    }

    /**
     * Cache geo results per IP for 24h to avoid hammering ip-api.com.
     */
    private function resolveLocationCached(string $ip): ?array
    {
        $cacheKey = 'visitor_geo:' . sha1($ip);

        $result = Cache::remember($cacheKey, self::GEO_CACHE_TTL_SECONDS, function () use ($ip) {
            return $this->resolveLocationFromApi($ip) ?? ['_geo_empty' => true];
        });

        if (! is_array($result) || ! empty($result['_geo_empty'])) {
            return null;
        }

        return $result;
    }

    private function resolveLocationFromApi(string $ip): ?array
    {
        if ($this->isLocalIp($ip)) {
            return [
                'country'   => 'Tanzania',
                'region'    => 'Dar es Salaam',
                'city'      => 'Dar es Salaam',
                'latitude'  => -6.7924,
                'longitude' => 39.2083,
            ];
        }

        try {
            $response = Http::timeout(2)
                ->get("http://ip-api.com/json/{$ip}", [
                    'fields' => 'status,country,regionName,city,lat,lon,message',
                ]);

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            if (($data['status'] ?? '') !== 'success') {
                Log::debug('ip-api.com non-success for IP ' . $ip . ': ' . ($data['message'] ?? 'unknown'));

                return null;
            }

            return [
                'country'   => $data['country']    ?? null,
                'region'    => $data['regionName'] ?? null,
                'city'      => $data['city']        ?? null,
                'latitude'  => $data['lat']         ?? null,
                'longitude' => $data['lon']         ?? null,
            ];
        } catch (\Throwable $e) {
            Log::debug('TrackVisitors geo lookup failed for ' . $ip . ': ' . $e->getMessage());

            return null;
        }
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        $skipPrefixes = ['home', 'login', 'register', 'logout', 'admin', 'dashboard',
            'student/', 'teacher/', 'department/', 'subject/', 'invoice/',
            'account/', 'setting/', 'user/', 'messages/', 'fees/',
            '_debugbar', 'telescope', 'horizon'];

        foreach ($skipPrefixes as $prefix) {
            if (str_starts_with($request->path(), $prefix)) {
                return false;
            }
        }

        if ($response->getStatusCode() >= 300) {
            return false;
        }

        $ua = strtolower($request->userAgent() ?? '');
        $bots = ['bot', 'crawl', 'spider', 'slurp', 'mediapartners', 'facebookexternalhit'];

        foreach ($bots as $bot) {
            if (str_contains($ua, $bot)) {
                return false;
            }
        }

        return true;
    }

    private function resolveSessionId(Request $request): string
    {
        try {
            return $request->session()->getId();
        } catch (\Throwable $e) {
            return $request->cookie(config('session.cookie', 'laravel_session'))
                ?? md5($request->ip() . $request->userAgent());
        }
    }

    private function resolveClientIp(Request $request): string
    {
        $ip = $request->ip();

        if (! empty($ip) && ! $this->isLocalIp($ip)) {
            return $ip;
        }

        $forwarded = $request->header('X-Forwarded-For');
        if ($forwarded) {
            $firstIp = trim(explode(',', $forwarded)[0]);
            if ($firstIp && ! $this->isLocalIp($firstIp)) {
                return $firstIp;
            }
        }

        return $ip ?: '127.0.0.1';
    }

    private function isLocalIp(string $ip): bool
    {
        if ($ip === '::1') {
            return true;
        }

        $privateRanges = ['127.', '10.', '192.168.'];

        foreach ($privateRanges as $prefix) {
            if (str_starts_with($ip, $prefix)) {
                return true;
            }
        }

        if (preg_match('/^172\.(1[6-9]|2\d|3[01])\./', $ip)) {
            return true;
        }

        return false;
    }
}

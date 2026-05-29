<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use View;

class AppServiceProvider extends ServiceProvider
{
    private const VISITOR_STATS_CACHE_KEY = 'frontend_visitor_stats';

    private const VISITOR_STATS_CACHE_TTL = 60;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ── Locale fallback ───────────────────────────────────────────────────
        if (! in_array(App::getLocale(), ['en', 'sw'])) {
            App::setLocale('sw');
        }

        // ── Force HTTPS behind reverse proxies (ngrok, production load balancer) ──
        if (
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'
        ) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // ── Share menus with all views ────────────────────────────────────────
        View::composer('*', fn ($view) =>
            $view->with('menus',
                Menu::whereNull('parent_id')
                    ->where('is_active', true)
                    ->with('children')
                    ->orderBy('order')
                    ->get()
            )
        );

        // ── Share site settings with all views ────────────────────────────────
        View::composer('*', function ($view) {
            $settingsPath = storage_path('app/settings.json');
            $siteSettings = ['website_name' => 'Kigamboni FDC', 'logo' => null, 'favicon' => null];
            if (file_exists($settingsPath)) {
                $decoded = json_decode(file_get_contents($settingsPath), true);
                if (is_array($decoded)) {
                    $siteSettings = array_merge($siteSettings, $decoded);
                }
            }
            $view->with('siteSettings', $siteSettings);
        });

        // ── Share visitor statistics (public frontend only) ───────────────────
        // Scoped to avoid DB load on admin, auth, email, and dashboard views.
        // Stats are cached for 60s so multiple frontend partials share one DB round-trip.
        View::composer([
            'frontend.*',
            'layouts.frontend',
            'frontend.partials.*',
        ], function ($view) {
            $emptyStats = [
                'vcOnline'    => 0,
                'vcYesterday' => 0,
                'vcWeekly'    => 0,
                'vcYearly'    => 0,
                'vcTotal'     => 0,
            ];

            try {
                $stats = Cache::remember(
                    self::VISITOR_STATS_CACHE_KEY,
                    self::VISITOR_STATS_CACHE_TTL,
                    function () use ($emptyStats) {
                    if (! Schema::hasTable('visitor_logs')) {
                        return $emptyStats;
                    }

                    $now = Carbon::now();

                    $vcOnline = (int) DB::table('visitor_logs')
                        ->where('last_activity', '>=', $now->copy()->subMinutes(5))
                        ->distinct('session_id')
                        ->count('session_id');

                    $vcYesterday = (int) DB::table('visitor_logs')
                        ->whereBetween('created_at', [$now->copy()->yesterday()->startOfDay(), $now->copy()->startOfDay()])
                        ->distinct('session_id')
                        ->count('session_id');

                    $vcWeekly = (int) DB::table('visitor_logs')
                        ->whereBetween('created_at', [$now->copy()->startOfWeek(), $now])
                        ->distinct('session_id')
                        ->count('session_id');

                    $vcYearly = (int) DB::table('visitor_logs')
                        ->whereBetween('created_at', [$now->copy()->startOfYear(), $now])
                        ->distinct('session_id')
                        ->count('session_id');

                    $permanentCount = Schema::hasTable('site_settings')
                        ? (int) (DB::table('site_settings')
                            ->where('key', 'total_lifetime_visitors')
                            ->value('value') ?? 0)
                        : 0;

                    $vcTotal = max($permanentCount, (int) DB::table('visitor_logs')->count());

                    return [
                        'vcOnline'    => $vcOnline,
                        'vcYesterday' => $vcYesterday,
                        'vcWeekly'    => $vcWeekly,
                        'vcYearly'    => $vcYearly,
                        'vcTotal'     => $vcTotal,
                    ];
                    }
                );
            } catch (\Throwable $e) {
                $stats = $emptyStats;
            }

            $view->with([
                'onlineCount'    => $stats['vcOnline'],
                'yesterdayCount' => $stats['vcYesterday'],
                'weeklyCount'    => $stats['vcWeekly'],
                'yearlyCount'    => $stats['vcYearly'],
                'totalCount'     => $stats['vcTotal'],
            ]);
        });
    }
}


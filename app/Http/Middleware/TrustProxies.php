<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * Trust ALL proxies — required for ngrok, Cloudflare, and any
     * reverse proxy that forwards the real client IP via X-Forwarded-For.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*';

    /**
     * Accept every forwarded header so Laravel's $request->ip()
     * always resolves to the real visitor IP, not the proxy's loopback.
     *
     * HEADER_X_FORWARDED_ALL covers:
     *   X-Forwarded-For, X-Forwarded-Host, X-Forwarded-Port, X-Forwarded-Proto
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalHostRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        $canonicalHost = (string) parse_url((string) config('app.url'), PHP_URL_HOST);
        if ($canonicalHost === '') {
            return $next($request);
        }

        $currentHost = $request->getHost();
        if (strcasecmp($currentHost, $canonicalHost) === 0) {
            return $next($request);
        }

        $target = $request->getScheme().'://'.$canonicalHost.$request->getRequestUri();

        return redirect()->to($target, 301);
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip for Livewire AJAX component updates — the actual page-load routes handle enforcement
        if ($request->hasHeader('X-Livewire')) {
            return $next($request);
        }

        if (
            auth()->check() &&
            auth()->user()->must_change_password &&
            ! $request->routeIs('password.change', 'logout', 'password.request', 'password.email')
        ) {
            return redirect()->route('password.change');
        }

        return $next($request);
    }
}

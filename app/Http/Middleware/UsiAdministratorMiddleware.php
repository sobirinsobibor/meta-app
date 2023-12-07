<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsiAdministratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  Check if the user is authenticated and has usi-admin privileges
        if (auth()->check() && auth()->user()->id_role === 2) {
            // If the user is an usi-admin, continue with the request
            return $next($request);
        }

        // If the user is not an usi-admin, redirect to a 403 page (Forbidden).
        return response()->view('starter.403', [], 403);
    }
}

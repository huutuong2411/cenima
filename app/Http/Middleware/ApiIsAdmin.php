<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!auth()->user() || auth()->user()->id_role !== 2) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        return $next($request);
    }
}

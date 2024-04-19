<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // return $role;
        if(!auth()->check()){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $user=auth()->user();
        if (! $user->roles()->where('name', 'editor')->exists()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}

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
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Jika user tidak ada atau tidak memiliki salah satu role yang diizinkan
        if (!$user || !in_array($user->role, $roles)) {
            return redirect()->route('no.access', ['role' => $user ? $user->role : 'guest']);
        }

        return $next($request);
    }
}

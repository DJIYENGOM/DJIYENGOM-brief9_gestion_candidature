<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

           
            $role = $user->role;

            if ($role == 'user') {
                return $next($request);
            } else {
                return response()->json(['message' => 'Autorisation refusée']);
            }
        } else {
            return response()->json(['message' => "vous n'êtes pas connecté"]);
        }
    }
}

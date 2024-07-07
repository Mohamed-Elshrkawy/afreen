<?php

namespace App\Http\Middleware;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->usertype !== $type) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}


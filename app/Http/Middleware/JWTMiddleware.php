<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Constants;
use App\Helpers\HttpHandler;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException){
                return HttpHandler::errorMessage(Constants::INVALID_TOKEN, 403);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'data' => [
                        'refresh_token' => JWTAuth::refresh(JWTAuth::getToken()),
                        'message' => 'Token is Expired'
                    ],
                    'status' => Constants::FAILED
                ], 401);
            } else {
                return HttpHandler::errorMessage(Constants::TOKEN_NOT_FOUND, 404);
            }
        }

        return $next($request);
    }
}

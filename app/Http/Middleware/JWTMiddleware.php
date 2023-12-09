<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Constants;
use App\Helpers\HttpHandler;
use Illuminate\Http\Response;
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
                return HttpHandler::errorMessage(Constants::INVALID_TOKEN, Response::HTTP_FORBIDDEN);
            } else if ($e instanceof TokenExpiredException) {
                return HttpHandler::errorMessage(Constants::EXPIRED_TOKEN, Response::HTTP_FORBIDDEN);
            } else {
                return HttpHandler::errorMessage(Constants::TOKEN_NOT_FOUND, Response::HTTP_NOT_FOUND);
            }
        }

        return $next($request);
    }
}

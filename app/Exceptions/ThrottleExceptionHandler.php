<?php

namespace App\Exceptions;

use App\Helpers\HttpHandler;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Throwable;

class ThrottleExceptionHandler extends Handler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ThrottleRequestsException) {
            $route = optional(Route::current())->uri();
            Log::error("Throttle exception for route '$route': " . $e->getMessage());
            return HttpHandler::errorMessage('Too many attempts, try again later after some time', 429);
        }

        return parent::render($request, $e);
    }
}

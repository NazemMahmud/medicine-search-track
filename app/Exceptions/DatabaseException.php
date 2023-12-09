<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DatabaseException extends Exception
{
    public function __construct($message = "", $code = Response::HTTP_INTERNAL_SERVER_ERROR, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

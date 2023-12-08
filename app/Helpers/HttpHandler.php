<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class HttpHandler
{
    /**
     * API success response
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function successResponse(mixed $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => Constants::SUCCESS
        ], $statusCode);
    }

    /**
     * API success message response
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function successMessage(string $message, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $message,
            ],
            'status' => Constants::SUCCESS
        ], $statusCode);
    }

    /**
     * API error message response
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function errorMessage(string $message, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'error' => $message,
            'status' => Constants::FAILED
        ], $statusCode);
    }

}

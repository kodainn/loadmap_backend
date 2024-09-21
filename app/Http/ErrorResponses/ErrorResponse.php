<?php

namespace App\Http\ErrorResponses;

use Illuminate\Http\JsonResponse;

class ErrorResponse
{
    public static function jsonEncode(
        int $status,
        string $message
    ): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $message
            ]
        ], $status);
    }
}
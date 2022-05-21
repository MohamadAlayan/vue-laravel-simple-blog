<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UnauthorizedException extends Exception
{
    /*
     *  401 Unauthorized
     */
    public function render(): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $this->getMessage() ?: 'Access is denied',
        ];

        return response()->json($response, 401);
    }
}

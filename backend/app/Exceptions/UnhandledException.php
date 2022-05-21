<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UnhandledException extends  Exception
{
    /*
     *  500 Internal Server Error
     *  This error is usually returned by the server when no other error code is suitable.
     */
    public function render(): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $this->getMessage() ?: 'Internal Server Error'
        ];

        return response()->json($response, 500);
    }
}

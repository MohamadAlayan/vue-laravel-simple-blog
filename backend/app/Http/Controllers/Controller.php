<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse($data, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'content' => $data
        ], $code);
    }

    /**
     * @param Request $request
     * @return object
     */
    protected function getRequestData(Request $request): object
    {
        if ($request->has('json_data')) {
            $data = $request->get('json_data');
        } else {
            $data = $request->getContent();
        }

        /** @noinspection JsonEncodingApiUsageInspection */
        $jsonData = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return (object)$request->all();
        }
        return (object)$jsonData;

    }
}

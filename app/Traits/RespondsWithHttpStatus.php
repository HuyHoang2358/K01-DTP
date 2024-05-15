<?php
namespace App\Traits;

use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

trait RespondsWithHttpStatus
{
    protected function success($message, $data = [], $status = 200): JsonResponse
    {

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = 422): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}

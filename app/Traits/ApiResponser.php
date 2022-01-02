<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;


trait ApiResponser
{

    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data = [], string $message = "", int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ], $code);
    }
    /**
     * @param mixed $data
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */

    protected function failResponse(string $message = "", $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'fail',
            'data_fail' => $data,
            'message' => $message
        ],$code);
    }

    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */

    protected function errorResponse(string $message = "", int $code = 500): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }

}

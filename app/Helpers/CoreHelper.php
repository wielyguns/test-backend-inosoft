<?php

/**
 * Response Data.
 *
 * @param  string  $message
 * @param  null  $data
 * @param  bool  $isSuccess
 * @param  int  $statusCode
 * @return JsonResponse
 */

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

if (!function_exists('getResponseData')) {
    function getResponseData(
        string $message = 'Success',
        bool $isSuccess = true,
        $data = null,
        int $statusCode = 200
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'error' => !$isSuccess,
            'result' => $data,
            'code' => $statusCode,
        ], $statusCode);
    }
}

/**
 * Default throw error on try catch.
 *
 * @param  string  $message
 * @param  null  $data
 * @param  int  $statusCode
 * @return JsonResponse
 */
if (!function_exists('getThrowCatch')) {
    function getThrowCatch(
        string $message = 'Error',
        $data = null,
        int $statusCode = Response::HTTP_BAD_REQUEST
    ): JsonResponse {
        $data = config('app.env') == 'production' ? 'Internal Server Error' : $data;
        return getResponseData($message, false, $data, $statusCode);
    }
}

/**
 * Shortcut for make connection mongo
 *
 * @return JsonResponse
 */
if (!function_exists('mongoTransaction')) {
    function mongoTransaction(): object
    {
        return DB::connection('mongodb')->getMongoClient()->startSession();
    }
}
/**
 * Converting date to format DB
 *
 * @return JsonResponse
 */
if (!function_exists('dateStore')) {
    function dateStore($param = null)
    {
        if ($param != null) {
            return \carbon\carbon::parse(str_replace('/', '-', $param))->format('Y-m-d');
        } else {
            return \carbon\carbon::now()->format('Y-m-d');
        }
    }
}
/**
 * Aggregate to parse any carbon date
 *
 * @return JsonResponse
 */
if (!function_exists('CarbonParse')) {
    function CarbonParse($date, $format)
    {
        return \carbon\carbon::parse($date)->format($format);
    }
}

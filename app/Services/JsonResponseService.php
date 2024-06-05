<?php

namespace App\Services;

class JsonResponseService
{
    public static function getJsonException($exception)
    {
        return response()->json([
            'message' => 'exception',
            'status' => 409,
            'response' => isset($exception->errorInfo[2]) ? $exception->errorInfo[2] : $exception->getMessage(),
        ], 409);
    }

    public static function getJsonSuccess($data)
    {
        return response()->json([
            'message' => 'Success',
            'status' => 200,
            'response' => $data,
        ], 200);
    }

    public static function JsonSuccess($message,$data)
    {
        return response()->json([
            'message' => $message,
            'operation'=>'1',
            'status' => 200,
            'response' => [
                'data'=>$data,
        ],
        ], 200);
    }

    public static function JsonFailed($message,$data)
    {
        return response()->json([
            'message' => $message,
            'operation'=>'0',
            'status' => 200,
            'response' => [
                'data'=>$data,
        ],
        ], 409);
    }



    public static function getJsonFailed($data)
    {
        return response()->json([
            'message' => 'Failed',
            'status' => 400,
            'response' => $data,
        ], 400);
    }
}

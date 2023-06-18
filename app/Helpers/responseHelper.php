<?php

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

function responseSuccess(array $data = [], $statusCode = Response::HTTP_OK): JsonResponse
{
    $result = [
        'status' => true,
    ];

    foreach ($data as $key => $value) {
        $result[$key] = $value;
    }

    return response()->json($result, $statusCode);
}


function responseError(array $data = [], $statusCode = Response::HTTP_OK): JsonResponse
{
    $result = [
        'status' => false,
    ];

    foreach ($data as $key => $value) {
        $result[$key] = $value;
    }

    return response()->json($result, $statusCode);
}


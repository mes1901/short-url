<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use App\Contracts\ApiException as ApiExceptionContract;
use App\Contracts\ApiResponse as ApiResponseContract;

class ApiResponse extends JsonResponse
{
    public static  function success(ApiResponseContract $response): self
    {
        return new static([
            'data' => $response
        ]);
    }

    public static function emptySuccess(): self
    {
        return new static();
    }

    public static function error(ApiExceptionContract $exception): self
    {
        return new static([
            'error' => $exception->toArray()
        ], $exception->getStatus());
    }

    public static function deleted(): self
    {
        return new static(null, 204);
    }
}
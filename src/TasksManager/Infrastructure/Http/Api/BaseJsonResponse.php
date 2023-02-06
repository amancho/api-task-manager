<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

final class BaseJsonResponse extends JsonResponse
{
    private const ERRORS = 'errors';

    public static function createFromResponse(array $response, int $status = Response::HTTP_OK): JsonResponse
    {
        return new self($response, $status);
    }

    public static function createFromException(Throwable $exception): JsonResponse
    {
        return new self(
            [self::ERRORS => [$exception->getMessage()]],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    public static function createFromNotFoundException(Throwable $exception): JsonResponse
    {
        return new self(
            [self::ERRORS => [$exception->getMessage()]],
            Response::HTTP_NOT_FOUND
        );
    }
}
<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Throwable;

final class GetTaskListController
{
    public function execute(): JsonResponse
    {
        try {
            $response = [];

            return BaseJsonResponse::createFromResponse($response);
        } catch (Throwable $exception) {
            return BaseJsonResponse::createFromException($exception);
        }
    }
}
<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Tappx\Tasks\TasksManager\Application\Query\GetTask\GetTaskQuery;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;
use Throwable;

final class GetTaskController
{
    public function execute(string $taskId): JsonResponse
    {
        try {

            $getTaskQuery = new GetTaskQuery(
                new TaskFileRepository()
            );

            return BaseJsonResponse::createFromResponse($getTaskQuery->execute($taskId));
        } catch (TaskNotFound $notFoundException) {
            return BaseJsonResponse::createFromNotFoundException($notFoundException);
        } catch (Throwable $exception) {
            return BaseJsonResponse::createFromException($exception);
        }
    }
}

<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Tappx\Tasks\TasksManager\Application\Query\GetTaskList\GetTaskListQuery;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;
use Throwable;

final class GetTaskListController
{
    public function execute(): JsonResponse
    {
        try {
            $getTasksListQuery = new GetTaskListQuery(
                new TaskFileRepository()
            );

            return BaseJsonResponse::createFromResponse($getTasksListQuery->execute());
        } catch (Throwable $exception) {
            return BaseJsonResponse::createFromException($exception);
        }
    }
}

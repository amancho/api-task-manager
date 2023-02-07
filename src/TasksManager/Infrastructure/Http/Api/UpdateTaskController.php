<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tappx\Tasks\TasksManager\Application\Command\UpdateTask\UpdateTask;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;
use Throwable;

final class UpdateTaskController
{
    public function execute(string $taskId, Request $request): JsonResponse
    {
        try {

            $task = $request->getContent();

            $saveTaskCommand = new UpdateTask(
                new TaskFileRepository()
            );

            return BaseJsonResponse::createFromResponse($saveTaskCommand->execute($taskId, $task));
        } catch (TaskNotFound $notFoundException) {
            return BaseJsonResponse::createFromNotFoundException($notFoundException);
        } catch (Throwable $exception) {
            return BaseJsonResponse::createFromException($exception);
        }
    }
}

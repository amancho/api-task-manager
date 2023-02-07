<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Tappx\Tasks\TasksManager\Application\Command\DeleteTask\DeleteTask;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;
use Throwable;

final class DeleteTaskController
{
    public function execute(string $taskId): JsonResponse
    {
        try {

            $deleteTaskCommand = new DeleteTask(
                new TaskFileRepository()
            );

            $deleteTaskCommand->execute($taskId);

            return BaseJsonResponse::createFromResponse([], Response::HTTP_NO_CONTENT);
        } catch (TaskNotFound $notFoundException) {
            return BaseJsonResponse::createFromNotFoundException($notFoundException);
        } catch (Throwable $exception) {
            return BaseJsonResponse::createFromException($exception);
        }
    }
}

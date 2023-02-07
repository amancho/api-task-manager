<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Http\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tappx\Tasks\TasksManager\Application\Command\SaveTask\SaveTask;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;
use Throwable;

final class SaveTaskController
{
    public function execute(Request $request,): JsonResponse
    {
        try {

            $task = $request->getContent();

            $saveTaskCommand = new SaveTask(
                new TaskFileRepository()
            );

            return BaseJsonResponse::createFromResponse($saveTaskCommand->execute($task), Response::HTTP_CREATED);
        } catch (Throwable $exception) {
            return BaseJsonResponse::createFromException($exception);
        }
    }
}

<?php

namespace Tappx\Tasks\TasksManager\Application\Query\GetTask;

use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;

final class GetTaskQuery
{
    public function __construct(private readonly TaskRepository $taskRepository)
    {

    }

    /**
     * @throws TaskNotFound
     * @throws FileNotFound
     */
    public function execute(string $taskId): array
    {
        $taskId = TaskId::fromString($taskId);
        $task = $this->taskRepository->searchById($taskId);

        return GetTaskResponse::createFromTask($task)->toArray();
    }
}
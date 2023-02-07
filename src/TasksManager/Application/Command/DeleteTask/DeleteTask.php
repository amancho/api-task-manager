<?php

namespace Tappx\Tasks\TasksManager\Application\Command\DeleteTask;

use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;

final class DeleteTask
{
    public function __construct(private readonly TaskRepository $taskRepository)
    {
    }

    /**
     * @throws FileNotFound
     * @throws TaskNotFound
     */
    public function execute(string $taskId): void
    {
        $this->taskRepository->delete(TaskId::fromString($taskId));
    }
}
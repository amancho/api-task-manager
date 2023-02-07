<?php

namespace Tappx\Tasks\TasksManager\Application\Command\UpdateTask;

use Tappx\Tasks\TasksManager\Domain\Task\Error\RequiredFieldError;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskUpdatedAt;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;

final class UpdateTask
{
    public function __construct(private readonly TaskRepository $taskRepository)
    {
    }

    /**
     * @throws RequiredFieldError
     * @throws FileNotFound
     * @throws TaskNotFound
     */
    public function execute(string $taskId, string $taskContent): array
    {
        $sourceTask = $this->taskRepository->searchById(TaskId::fromString($taskId));
        $task = Task::createFromJson($taskContent);

        $updatedTask = Task::create(
            $sourceTask->id(),
            $task->title(),
            $task->status(),
            $sourceTask->createdAt(),
            TaskUpdatedAt::create(),
        );

        $this->taskRepository->update($updatedTask);

        return UpdateTaskResponse::createFromTask($updatedTask)->toArray();
    }
}
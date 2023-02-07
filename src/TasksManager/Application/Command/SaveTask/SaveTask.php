<?php

namespace Tappx\Tasks\TasksManager\Application\Command\SaveTask;

use Tappx\Tasks\TasksManager\Domain\Task\Error\RequiredFieldError;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskIdDuplicated;

final class SaveTask
{
    public function __construct(private readonly TaskRepository $taskRepository)
    {
    }

    /**
     * @throws RequiredFieldError
     * @throws FileNotFound
     * @throws TaskIdDuplicated
     */
    public function execute(string $task): array
    {
        $newTask = Task::createFromJson($task);
        $task = $this->taskRepository->save($newTask);

        return SaveTaskResponse::createFromTask($task)->toArray();
    }
}
<?php

namespace Tappx\Tasks\TasksManager\Application\Command\UpdateTask;

use Tappx\Tasks\TasksManager\Domain\Task\Task;

final class UpdateTaskResponse
{
    public function __construct(private readonly Task $task)
    {
    }

    public static function createFromTask(Task $task): UpdateTaskResponse
    {
        return new self($task);
    }

    public function toArray(): array
    {
        return $this->task->toArray();
    }
}

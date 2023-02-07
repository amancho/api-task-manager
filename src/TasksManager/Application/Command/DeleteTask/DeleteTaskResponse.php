<?php

namespace Tappx\Tasks\TasksManager\Application\Command\DeleteTask;

use Tappx\Tasks\TasksManager\Domain\Task\Task;

final class DeleteTaskResponse
{
    public function __construct(private readonly Task $task)
    {
    }

    public static function createFromTask(Task $task): DeleteTaskResponse
    {
        return new self($task);
    }

    public function toArray(): array
    {
        return $this->task->toArray();
    }
}

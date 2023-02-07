<?php

namespace Tappx\Tasks\TasksManager\Application\Command\SaveTask;

use Tappx\Tasks\TasksManager\Domain\Task\Task;

final class SaveTaskResponse
{
    public function __construct(private readonly Task $task)
    {
    }

    public static function createFromTask(Task $task): SaveTaskResponse
    {
        return new self($task);
    }

    public function toArray(): array
    {
        return $this->task->toArray();
    }
}

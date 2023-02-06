<?php

namespace Tappx\Tasks\TasksManager\Application\Query\GetTask;

use Tappx\Tasks\TasksManager\Domain\Task\Task;

final class GetTaskResponse
{
    public function __construct(private readonly Task $task)
    {
    }

    public static function createFromTask(Task $task): GetTaskResponse
    {
        return new self($task);
    }

    public function toArray(): array
    {
        return $this->task->toArray();
    }
}

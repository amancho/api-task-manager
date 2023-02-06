<?php

namespace Tappx\Tasks\TasksManager\Application\Query\GetTaskList;

use Tappx\Tasks\TasksManager\Domain\Task\TaskCollection;

final class GetTaskListResponse
{
    public function __construct(private readonly TaskCollection $taskCollection)
    {
    }

    public static function createFromCollection(TaskCollection $taskCollection): GetTaskListResponse
    {
        return new self($taskCollection);
    }

    public function toArray(): array
    {
        $response = [];

        foreach($this->taskCollection as $task) {
            $response[] = $task->toArray();
        }

        return $response;
    }
}
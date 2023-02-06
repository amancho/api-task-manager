<?php

namespace Tappx\Tasks\TasksManager\Domain\Task;


use Tappx\Tasks\Shared\Collection;

final class TaskCollection extends Collection
{
    public function add(Task ...$tasks): void
    {
        foreach ($tasks as $task) {
            $this->items[] = $task;
        }
    }

    protected function type(): string
    {
        return Task::class;
    }
}
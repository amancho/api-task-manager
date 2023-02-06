<?php

namespace Tappx\Tasks\TasksManager\Domain\Task;

use Tappx\Tasks\Shared\Domain\Error\InvalidCollectionItemType;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;

interface TaskRepository
{
    /**
     * @throws InvalidCollectionItemType
     * @throws FileNotFound
     */
    public function list(): TaskCollection;
}
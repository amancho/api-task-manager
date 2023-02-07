<?php

namespace Tappx\Tasks\TasksManager\Domain\Task;

use Tappx\Tasks\TasksManager\Domain\Task\Error\RequiredFieldError;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskIdDuplicated;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;
use Tappx\Tasks\Shared\Domain\Error\InvalidCollectionItemType;


interface TaskRepository
{
    /**
     * @throws InvalidCollectionItemType
     * @throws FileNotFound
     */
    public function list(): TaskCollection;

    /**
     * @throws FileNotFound
     * @throws TaskNotFound
     */
    public function searchById(TaskId $taskId): Task;

    /**
     * @throws RequiredFieldError
     * @throws FileNotFound
     * @throws TaskIdDuplicated
     */
    public function save(Task $task): Task;
}
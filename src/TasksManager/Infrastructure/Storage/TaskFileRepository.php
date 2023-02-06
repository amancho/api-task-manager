<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Storage;

use Tappx\Tasks\Shared\Domain\Error\InvalidCollectionItemType;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Domain\Task\TaskCollection;
use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskCreatedAt;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskStatus;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskTitle;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskUpdatedAt;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;

final class TaskFileRepository implements TaskRepository
{
    private array $tasks;

    public function __construct(private ?string $filePath = null)
    {
        if (empty($filePath)) {
            $this->filePath = base_path() . '/storage/tasks.json';
        }
    }

    /**
     * @throws InvalidCollectionItemType
     * @throws FileNotFound
     */
    public function list(): TaskCollection
    {
        $this->getTasksFromFile();

        return new TaskCollection(...$this->tasks);
    }

    /**
     * @throws FileNotFound
     */
    private function getTasksFromFile(): void
    {
        if (!\file_exists($this->filePath)) {
            throw FileNotFound::message($this->filePath);
        }

        if (empty($this->tasks)) {
            $fileContent = \file_get_contents($this->filePath);
            $fileTasks = \json_decode($fileContent, true);

            foreach($fileTasks as $task) {
                $this->tasks[$task['id']] = Task::createFromArray($task);
            }
        }
    }
}
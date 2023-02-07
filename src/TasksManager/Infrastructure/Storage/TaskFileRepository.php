<?php

namespace Tappx\Tasks\TasksManager\Infrastructure\Storage;

use Tappx\Tasks\Shared\Domain\Error\InvalidCollectionItemType;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Domain\Task\TaskCollection;
use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskIdDuplicated;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;

final class TaskFileRepository implements TaskRepository
{
    private array $tasks = [];

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
        $this->isValidFile();

        if (empty($this->tasks)) {
            $fileContent = \file_get_contents($this->filePath);
            $fileTasks = \json_decode($fileContent, true) ?? [];

            foreach ($fileTasks as $task) {
                $this->tasks[$task['id']] = Task::createFromArray($task);
            }
        }
    }

    /**
     * @throws FileNotFound
     */
    private function isValidFile(): void
    {
        if (!\file_exists($this->filePath)) {
            throw FileNotFound::message($this->filePath);
        }
    }

    /**
     * @throws FileNotFound
     * @throws TaskNotFound
     */
    public function searchById(TaskId $taskId): Task
    {
        $this->getTasksFromFile();
        $this->taskIdExists($taskId);

        return $this->tasks[$taskId->value()];
    }

    /**
     * @throws TaskNotFound
     */
    private function taskIdExists(TaskId $taskId): void
    {
        if (!\array_key_exists($taskId->value(), $this->tasks)) {
            throw TaskNotFound::message($taskId->value());
        }
    }

    /**
     * @throws FileNotFound
     * @throws TaskIdDuplicated
     */
    public function save(Task $task): Task
    {
        $this->getTasksFromFile();

        if (\array_key_exists($task->id()->value(), $this->tasks)) {
            throw TaskIdDuplicated::message($task->id()->value());
        }

        $this->tasks[$task->id()->value()] = $task;
        $this->persist();

        return $task;
    }

    /**
     * @throws FileNotFound
     */
    private function persist(): void
    {
        $this->isValidFile();

        $tasksToPersist = [];

        /* @var Task $task */
        foreach ($this->tasks as $task) {
            $tasksToPersist[] = $task->toArray();
        }

        \file_put_contents($this->filePath, \json_encode($tasksToPersist));
    }
}
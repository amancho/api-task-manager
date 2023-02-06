<?php

namespace Tappx\Tasks\TasksManager\Domain\Task;

use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskCreatedAt;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskStatus;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskTitle;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskUpdatedAt;

final class Task
{
    private const FIELD_ID = 'id';
    private const FIELD_TITLE = 'title';
    private const FIELD_STATUS = 'status';
    private const FIELD_CREATED_AT = 'created_at';
    private const FIELD_UPDATED_AT = 'updated_at';

    public function __construct(
        private readonly TaskId         $taskId,
        private readonly TaskTitle      $taskTitle,
        private readonly TaskStatus     $taskStatus,
        private readonly ?TaskCreatedAt $taskCreatedAt,
        private readonly ?TaskUpdatedAt $taskUpdatedAt
    )
    {
    }

    public static function create(
        TaskId        $taskId,
        TaskTitle     $taskTitle,
        TaskStatus    $taskStatus,
        TaskCreatedAt $taskCreatedAt,
        TaskUpdatedAt $taskUpdatedAt
    ): Task
    {
        return new self($taskId, $taskTitle, $taskStatus, $taskCreatedAt, $taskUpdatedAt);
    }

    public static function createFromArray(array $task): Task
    {
        return new self(
            new TaskId($task[self::FIELD_ID] ?? ''),
            new TaskTitle($task[self::FIELD_TITLE] ?? ''),
            new TaskStatus($task[self::FIELD_STATUS] ?? ''),
            new TaskCreatedAt($task[self::FIELD_CREATED_AT] ?? ''),
            new TaskUpdatedAt($task[self::FIELD_UPDATED_AT] ?? '')
        );
    }

    public function toArray(): array
    {
        return [
            self::FIELD_ID => $this->id()->value(),
            self::FIELD_TITLE => $this->title()->value(),
            self::FIELD_STATUS => $this->status()->value(),
            self::FIELD_CREATED_AT => $this->createdAt()->value(),
            self::FIELD_UPDATED_AT => $this->updatedAt()->value()
        ];
    }

    public function id(): TaskId
    {
        return $this->taskId;
    }

    public function title(): TaskTitle
    {
        return $this->taskTitle;
    }

    public function status(): TaskStatus
    {
        return $this->taskStatus;
    }

    public function createdAt(): TaskCreatedAt
    {
        return $this->taskCreatedAt;
    }

    public function updatedAt(): TaskUpdatedAt
    {
        return $this->taskUpdatedAt;
    }
}
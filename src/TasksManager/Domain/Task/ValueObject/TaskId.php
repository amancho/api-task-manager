<?php

namespace Tappx\Tasks\TasksManager\Domain\Task\ValueObject;

use Tappx\Tasks\Shared\Domain\ValueObject\StringValueObject;

final class TaskId extends StringValueObject
{
    public static function fromString(string $id): self
    {
        return new TaskId($id);
    }
}
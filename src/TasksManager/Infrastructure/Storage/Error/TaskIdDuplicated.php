<?php declare(strict_types=1);

namespace Tappx\Tasks\TasksManager\Infrastructure\Storage\Error;

use Exception;

final class TaskIdDuplicated extends Exception
{
    public static function message(string $taskId): self
    {
        return new self(\sprintf('Task ID %s already exists', $taskId));
    }
}

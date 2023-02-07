<?php declare(strict_types=1);

namespace Tappx\Tasks\TasksManager\Domain\Task\Error;

use Exception;

final class RequiredFieldError extends Exception
{
    public static function message(string $field): self
    {
        return new self(\sprintf('Required field %s not found or invalid', $field));
    }
}
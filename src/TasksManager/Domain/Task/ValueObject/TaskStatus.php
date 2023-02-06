<?php

namespace Tappx\Tasks\TasksManager\Domain\Task\ValueObject;

use Tappx\Tasks\Shared\Domain\ValueObject\StringValueObject;

final class TaskStatus extends StringValueObject
{
    private const DONE = 'DONE';
    private const DOING = 'DOING';
    private const PENDING = 'PENDING';
    private const CANCELED = 'CANCELED';

    public static function done(): self
    {
        return new self(self::DONE);
    }

    public static function doing(): self
    {
        return new self(self::DOING);
    }

    public static function isValid(string $value): bool
    {
        return \in_array(\strtoupper($value), [self::DONE, self::DOING, self::PENDING, self::CANCELED]);
    }

    public static function pending(): self
    {
        return new self(self::PENDING);
    }

    public static function canceled(): self
    {
        return new self(self::CANCELED);
    }
}

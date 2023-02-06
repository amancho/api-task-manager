<?php

namespace Tappx\Tasks\TasksManager\Domain\Task\ValueObject;

use Tappx\Tasks\Shared\Domain\ValueObject\DateValueObject;

final class TaskUpdatedAt extends DateValueObject
{
    public static function create(): TaskUpdatedAt
    {
        return new TaskUpdatedAt(\date(self::DEFAULT_DATE_TIME_FORMAT));
    }
}
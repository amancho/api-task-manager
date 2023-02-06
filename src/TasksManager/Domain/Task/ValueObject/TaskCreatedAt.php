<?php

namespace Tappx\Tasks\TasksManager\Domain\Task\ValueObject;

use Tappx\Tasks\Shared\Domain\ValueObject\DateValueObject;

final class TaskCreatedAt extends DateValueObject
{
    public static function create(): TaskCreatedAt
    {
        return new TaskCreatedAt(\date(self::DEFAULT_DATE_TIME_FORMAT));
    }
}
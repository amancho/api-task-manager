<?php

namespace Tappx\Tasks\Tests\Unit\TaskManager\Domain\Task;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskCreatedAt;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskStatus;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskTitle;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskUpdatedAt;

final class TaskTest extends TestCase
{

    private Generator $faker;

    public function test_user_works()
    {
        $taskId = (string)$this->faker->numberBetween(10, 99);
        $taskTitle = $this->faker->words(5, true);

        $task = Task::create(
            new TaskId($taskId),
            new TaskTitle($taskTitle),
            TaskStatus::done(),
            TaskCreatedAt::create(),
            TaskUpdatedAt::create(),
        );

        $this->assertInstanceOf(Task::class, $task);
        $this->assertIsString($task->id()->value());
        $this->assertIsString($task->title()->value());
    }

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }
}
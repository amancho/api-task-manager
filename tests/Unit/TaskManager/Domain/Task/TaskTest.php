<?php

namespace Tappx\Tasks\Tests\Unit\TaskManager\Domain\Task;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Tappx\Tasks\TasksManager\Domain\Task\Error\RequiredFieldError;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskCreatedAt;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskId;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskStatus;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskTitle;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskUpdatedAt;

final class TaskTest extends TestCase
{

    private const FIELD_ID = 'id';
    private const FIELD_TITLE = 'title';
    private const FIELD_STATUS = 'status';
    private const FIELD_CREATED_AT = 'created_at';
    private const FIELD_UPDATED_AT = 'updated_at';

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

    public function test_it_user_create_from_json_works()
    {
        $taskValues = [
            self::FIELD_ID => uniqid(),
            self::FIELD_TITLE => uniqid(),
            self::FIELD_STATUS => TaskStatus::pending()->value(),
            self::FIELD_CREATED_AT => TaskCreatedAt::create()->value(),
            self::FIELD_UPDATED_AT => (string) null
        ];

        $taskDomainObject = Task::createFromJson(\json_encode($taskValues));

        $this->assertInstanceOf(Task::class, $taskDomainObject);
        $this->assertSame($taskValues, $taskDomainObject->toArray());
    }

    /** @dataProvider invalidTasksProvider */
    public function test_it_user_create_from_invalid_json_fails(array $task)
    {
        $this->expectException(RequiredFieldError::class);

        Task::createFromJson(\json_encode($task));
    }

    public function invalidTasksProvider(): array
    {
        return [
            'Without required fields' => [
                'task' => [
                    'idx1' => null,
                    'titlex2' => null,
                ]
            ],
            'Invalid status' => [
                'task' => [
                    self::FIELD_ID => uniqid(),
                    self::FIELD_TITLE => uniqid(),
                    self::FIELD_STATUS => uniqid()
                ]
            ],
        ];
    }

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }
}
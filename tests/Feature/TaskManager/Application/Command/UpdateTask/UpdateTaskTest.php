<?php

namespace Tappx\Tasks\Tests\Feature\TaskManager\Application\Command\UpdateTask;

use PHPUnit\Framework\TestCase;
use Tappx\Tasks\TasksManager\Application\Command\UpdateTask\UpdateTask;
use Tappx\Tasks\TasksManager\Domain\Task\Error\RequiredFieldError;
use Tappx\Tasks\TasksManager\Domain\Task\ValueObject\TaskStatus;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;

final class UpdateTaskTest extends TestCase
{
    private const FIELD_ID = 'id';
    private const FIELD_TITLE = 'title';
    private const FIELD_STATUS = 'status';
    private const FIELD_CREATED_AT = 'created_at';
    private const TEST_PATH = '/var/www/html/tests/Feature/TaskManager/Application/Command/UpdateTask/';
    private const FILE_EMPTY = 'tasksTest.json';
    private UpdateTask $sut;

    private string $taskId = "1";

    public function test_it_update_tasks_works(): void
    {
        $updatedTask = [
            self::FIELD_TITLE => 'Update task title',
            self::FIELD_STATUS => TaskStatus::pending()->value()
        ];

        $savedTask = $this->sut->execute($this->taskId, \json_encode($updatedTask));

        $this->assertEquals($this->taskId, $savedTask[self::FIELD_ID]);
        $this->assertEquals('2023-02-01 10:00:00', $savedTask[self::FIELD_CREATED_AT]);
        $this->assertEquals($updatedTask[self::FIELD_TITLE], $savedTask[self::FIELD_TITLE]);
        $this->assertEquals($updatedTask[self::FIELD_STATUS], $savedTask[self::FIELD_STATUS]);
    }

    public function test_it_update_tasks_with_invalid_id_fails(): void
    {
        $this->expectException(TaskNotFound::class);
        $this->sut->execute(rand(10, 99), '');
    }

    public function test_it_update_tasks_with_invalid_status_fails(): void
    {
        $this->expectException(RequiredFieldError::class);

        $updatedTask = [
            self::FIELD_TITLE => 'Update task title',
            self::FIELD_STATUS => 'InvalidStatus'
        ];

       $this->sut->execute($this->taskId, \json_encode($updatedTask));
    }

    public function test_it_update_tasks_with_invalid_fields_fails(): void
    {
        $this->expectException(RequiredFieldError::class);

        $updatedTask = [
            'InvalidField1' => 'Update task title',
            'InvalidField2' => 'InvalidStatus'
        ];

        $this->sut->execute($this->taskId, \json_encode($updatedTask));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new UpdateTask(
            new TaskFileRepository(self::TEST_PATH . self::FILE_EMPTY)
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearTestFile();
    }

    private function clearTestFile(): void
    {
        $defaultTask = [
            [
                "id" => "1",
                "title" => "Clean up",
                "created_at" => "2023-02-01 10:00:00",
                "updated_at" => null,
                "status" => "PENDING"
            ]
        ];

        \file_put_contents(self::TEST_PATH . self::FILE_EMPTY, \json_encode($defaultTask));
    }
}
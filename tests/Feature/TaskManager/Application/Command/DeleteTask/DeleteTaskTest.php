<?php

namespace Tappx\Tasks\Tests\Feature\TaskManager\Application\Command\DeleteTask;

use PHPUnit\Framework\TestCase;
use Tappx\Tasks\TasksManager\Application\Command\DeleteTask\DeleteTask;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\TaskNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;

final class DeleteTaskTest extends TestCase
{

    private const TEST_PATH = '/var/www/html/tests/Feature/TaskManager/Application/Command/UpdateTask/';
    private const FILE_EMPTY = 'tasksTest.json';
    private DeleteTask $sut;

    private string $taskId = "1";

    public function test_it_delete_task_works(): void
    {
        $this->sut->execute($this->taskId);

        $fileContent = \file_get_contents(self::TEST_PATH . self::FILE_EMPTY);
        $fileTasks = \json_decode($fileContent, true) ?? [];

        $this->assertEmpty($fileTasks);
    }

    public function test_it_delete_task_with_invalid_id_fails(): void
    {
        $this->expectException(TaskNotFound::class);
        $this->sut->execute(rand(10, 99));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new DeleteTask(
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

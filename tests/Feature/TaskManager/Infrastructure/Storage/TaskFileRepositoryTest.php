<?php

namespace Tappx\Tasks\Tests\Feature\TaskManager\Infrastructure\Storage;

use PHPUnit\Framework\TestCase;
use Tappx\Tasks\TasksManager\Domain\Task\Task;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\TaskFileRepository;

final class TaskFileRepositoryTest extends TestCase
{

    private const TEST_PATH = '/var/www/html/tests/Feature/TaskManager/Infrastructure/Storage/';
    private const FILE_TASKS = 'tasksTest.json';
    private TaskFileRepository $sut;

    public function test_it_list_tasks_throws_file_not_found(): void
    {
        $this->setFile(uniqid() . '.json');
        $this->expectException(FileNotFound::class);

        $this->sut->list();
    }

    private function setFile(string $filePath)
    {
        $this->sut = new TaskFileRepository(self::TEST_PATH . $filePath);
    }

    public function test_it_list_tasks_works(): void
    {
        $this->setFile(self::FILE_TASKS);

        $taskCollection = $this->sut->list();

        $this->assertCount(7, $taskCollection);
        $this->assertInstanceOf(Task::class, $taskCollection->first());
        $this->assertEquals('Clean up', $taskCollection->first()->title()->value());
    }
}
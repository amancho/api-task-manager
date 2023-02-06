<?php

namespace Tappx\Tasks\TasksManager\Application\Query\GetTaskList;

use Tappx\Tasks\Shared\Domain\Error\InvalidCollectionItemType;
use Tappx\Tasks\TasksManager\Domain\Task\TaskRepository;
use Tappx\Tasks\TasksManager\Infrastructure\Storage\Error\FileNotFound;

final class GetTaskListQuery
{
    public function __construct(private readonly TaskRepository $taskListRepository)
    {

    }

    /**
     * @throws InvalidCollectionItemType
     * @throws FileNotFound
     */
    public function execute(): array
    {
        $taskListCollection = $this->taskListRepository->list();

        return GetTaskListResponse::createFromCollection($taskListCollection)->toArray();
    }
}
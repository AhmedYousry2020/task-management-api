<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $taskRepository,
        protected ProjectRepositoryInterface $projectRepository,
    ) {
    }

    public function list(
        int $userId,
        array $filters
    ): LengthAwarePaginator {

        return $this->taskRepository
            ->paginateByUser($userId, $filters);
    }

    public function create(
        array $data,
        int $userId
    ): Task {

        $this->projectRepository->findByIdForUser(
            $data['project_id'],
            $userId
        );

        return $this->taskRepository->create($data);
    }

    public function find(
        int $taskId,
        int $userId
    ): Task {

        return $this->taskRepository
            ->findByIdForUser($taskId, $userId);
    }

    public function update(
        Task $task,
        array $data
    ): Task {

        if (isset($data['project_id'])) {
            $this->projectRepository->findByIdForUser(
                $data['project_id'],
                auth()->id()
            );
        }

        return $this->taskRepository
            ->update($task, $data);
    }

    public function delete(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
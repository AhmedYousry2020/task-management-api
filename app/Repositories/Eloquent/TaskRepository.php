<?php

namespace App\Repositories\Eloquent;

use App\Filters\TaskFilter;
use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(
        protected Task $model,
        protected TaskFilter $filter
    ) {
    }

    public function paginateByUser(
        int $userId,
        array $filters,
        int $perPage = 10
    ): LengthAwarePaginator {

        $query = $this->model->with('project')
            ->whereHas('project', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });

        return $this->filter
            ->apply($query, $filters)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Task
    {
        return $this->model->create($data);
    }

    public function findByIdForUser(
        int $taskId,
        int $userId
    ): Task {

        return $this->model
            ->whereHas('project', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->findOrFail($taskId);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task->fresh();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
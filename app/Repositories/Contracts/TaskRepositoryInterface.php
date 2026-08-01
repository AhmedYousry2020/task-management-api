<?php

namespace App\Repositories\Contracts;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function paginateByUser(int $userId, array $filters, int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Task;

    public function findByIdForUser(int $taskId, int $userId): Task;

    public function update(Task $task, array $data): Task;

    public function delete(Task $task): void;
}
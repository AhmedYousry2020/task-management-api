<?php

namespace App\Repositories\Contracts;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Project;

    public function findByIdForUser(int $id, int $userId): Project;

    public function update(Project $project, array $data): Project;

    public function delete(Project $project): void;
}
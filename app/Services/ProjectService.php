<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $repository
    ) {}

    public function list(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginateByUser($userId, $perPage);
    }

    public function create(array $data, int $userId): Project
    {
        $data['user_id'] = $userId;

        return $this->repository->create($data);
    }

    public function find(int $projectId, int $userId): Project
    {
        return $this->repository->findByIdForUser($projectId, $userId);
    }

    public function update(Project $project, array $data): Project
    {
        return $this->repository->update($project, $data);
    }

    public function delete(Project $project): void
    {
        $this->repository->delete($project);
    }
}
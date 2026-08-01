<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(
        protected Project $model
    ) {}

    public function paginateByUser(
        int $userId,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->model
            ->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Project
    {
        return $this->model->create($data)->fresh();
    }

    public function findByIdForUser(
        int $id,
        int $userId
    ): Project {
        return $this->model
            ->where('user_id', $userId)
            ->findOrFail($id);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project->fresh();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
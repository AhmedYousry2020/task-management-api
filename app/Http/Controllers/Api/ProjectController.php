<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected ProjectService $service
    ) {}

    public function index(): JsonResponse
    {
        $projects = $this->service->list(auth()->id());

        return $this->successPaginated(
            ProjectResource::collection($projects),
            'Projects retrieved successfully.'
        );
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->service->create(
            $request->validated(),
            auth()->id()
        );

        return $this->success(
            data: new ProjectResource($project),
            message: 'Project created successfully.',
            status: 201
        );
    }

    public function show(int $project): JsonResponse
    {
        $project = $this->service->find(
            $project,
            auth()->id()
        );

        return $this->success(
            data: new ProjectResource($project),
            message: 'Project retrieved successfully.'
        );
    }

    public function update(
        UpdateProjectRequest $request,
        int $project
    ): JsonResponse {

        $project = $this->service->find(
            $project,
            auth()->id()
        );

        $project = $this->service->update(
            $project,
            $request->validated()
        );

        return $this->success(
            data: new ProjectResource($project),
            message: 'Project updated successfully.'
        );
    }

    public function destroy(int $project): JsonResponse
    {
        $project = $this->service->find(
            $project,
            auth()->id()
        );

        $this->service->delete($project);

        return $this->success(
            message: 'Project deleted successfully.'
        );
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected TaskService $service
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $tasks = $this->service->list(
            auth()->id(),
            $request->only([
                'project_id',
                'status',
                'priority',
                'search',
            ])
        );

        return $this->successPaginated(
            TaskResource::collection($tasks),
            'Tasks retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->service->create(
            $request->validated(),
            auth()->id()
        );

        return $this->success(
            data: new TaskResource($task),
            message: 'Task created successfully.',
            status: 201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $taskId): JsonResponse
    {
        $task = $this->service->find(
            $taskId,
            auth()->id()
        );

        return $this->success(
            data: new TaskResource($task),
            message: 'Task retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $task): JsonResponse
    {
        $task = $this->service->find(
            $task,
            auth()->id()
        );

        $task = $this->service->update(
            $task,
            $request->validated()
        );

        return $this->success(
            data: new TaskResource($task),
            message: 'Task updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task): JsonResponse
    {
        $task = $this->service->find(
            $task,
            auth()->id()
        );

        $this->service->delete($task);

        return $this->success(
            message: 'Task deleted successfully.'
        );
    }
}

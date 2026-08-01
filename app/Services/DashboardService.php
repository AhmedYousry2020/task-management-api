<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;

class DashboardService
{
    public function statistics(int $userId): array
    {
        $projectIds = Project::where('user_id', $userId)
            ->pluck('id');

        return [

            'total_projects' => Project::where('user_id', $userId)->count(),

            'active_projects' => Project::where('user_id', $userId)
                ->where('status', 'active')
                ->count(),

            'total_tasks' => Task::whereIn('project_id', $projectIds)
                ->count(),

            'completed_tasks' => Task::whereIn('project_id', $projectIds)
                ->where('status', 'done')
                ->count(),

            'pending_tasks' => Task::whereIn('project_id', $projectIds)
                ->where('status', '!=', 'done')
                ->count(),

            'overdue_tasks' => Task::whereIn('project_id', $projectIds)
                ->where('status', '!=', 'done')
                ->whereDate('due_date', '<', now())
                ->count(),
        ];
    }
}
<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter
{
    public function apply(
        Builder $query,
        array $filters
    ): Builder {

        return $query

            ->when(
                $filters['project_id'] ?? null,
                fn($q, $value) =>
                    $q->where('project_id', $value)
            )

            ->when(
                $filters['status'] ?? null,
                fn($q, $value) =>
                    $q->where('status', $value)
            )

            ->when(
                $filters['priority'] ?? null,
                fn($q, $value) =>
                    $q->where('priority', $value)
            )

            ->when(
                $filters['search'] ?? null,
                fn($q, $value) =>
                    $q->where(
                        'title',
                        'like',
                        "%{$value}%"
                    )
            );
    }
}
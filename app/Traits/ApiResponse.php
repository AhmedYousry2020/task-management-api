<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success(
        mixed $data = null,
        string $message = 'Success',
        array $additional = [],
        int $status = 200
    ): JsonResponse {
        return response()->json(array_merge([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $additional), $status);
    }

    protected function successPaginated(
        mixed $paginator,
        string $message = 'Success'
    ): JsonResponse {
        $items = $paginator instanceof \Illuminate\Http\Resources\Json\AnonymousResourceCollection
            ? $paginator->resolve()
            : $paginator->items();

        $paginator = $paginator instanceof \Illuminate\Http\Resources\Json\AnonymousResourceCollection
            ? $paginator->resource
            : $paginator;

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $items,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
        ]);
    }

    protected function error(
        string $message = 'Error',
        mixed $errors = [],
        int $status = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}

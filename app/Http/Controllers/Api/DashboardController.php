<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected DashboardService $service
    ) {
    }
    
    public function index(): JsonResponse
    {
        return $this->success(
            data: $this->service->statistics(auth()->id()),
            message: 'Dashboard retrieved successfully.'
        );
    }
}

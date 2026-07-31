<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected AuthService $service
    ) {}

    // register user
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->service->register(
            $request->validated()
        );

        return $this->success(
            data: new UserResource($result['user']),
            message: 'Registered Successfully',
            additional: [
                'token' => $result['token'],
            ],
            status: 201
        );
    }

    // login user
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->service->login(
            $request->validated()
        );

        return $this->success(
            data: new UserResource($result['user']),
            message: 'Login Successfully',
            additional: [
                'token' => $result['token'],
            ],
            status: 201
        );
    }

    // logout user
    public function logout(): JsonResponse
    {
        $this->service->logout(auth()->user());

        return $this->success(
            data: null,
            message: 'Logout Successfully'
        );
    }
}

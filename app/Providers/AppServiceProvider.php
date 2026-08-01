<?php

namespace App\Providers;

use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );

        $this->app->bind(
            ProjectRepositoryInterface::class,
            ProjectRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

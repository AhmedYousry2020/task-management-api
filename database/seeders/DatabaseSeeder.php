<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Project::factory(5)
            ->create([
                'user_id' => $testUser->id,
            ])
            ->each(function ($project) {
            Task::factory(10)->create([
                'project_id' => $project->id,
            ]);
        });

        User::factory(9)
            ->create()
            ->each(function ($user) {
                Project::factory(5)
                    ->create([
                        'user_id' => $user->id,
                    ])
                    ->each(function ($project) {
                        Task::factory(10)
                            ->create([
                                'project_id' => $project->id,
                            ]);
                    });
            });
    }
}

<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement(
                array_column(TaskPriority::cases(), 'value')
            ),
            'status' => fake()->randomElement(
                array_column(TaskStatus::cases(), 'value')
            ),
            'due_date' => fake()->dateTimeBetween('-7 days', '+30 days'),
        ];
    }
}

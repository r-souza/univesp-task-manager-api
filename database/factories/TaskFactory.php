<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
            'name'          => $this->faker->unique()->sentence(2, false),
            'description'   => $this->faker->paragraph(2),
            'completed'     => $this->faker->boolean(50),
            'priority_id'   => Priority::factory(),
            'project_id'    => Project::factory(),
            'status_id'     => Status::factory(),
            'user_id'       => User::factory()
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Workspace;
use App\Models\Project;

use App\Enums\Issue\Status;
use App\Enums\Issue\Priority;
use App\Enums\Issue\Platform;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workspace_id' => Workspace::factory(),
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => Status::OPEN,
            'priority' => Priority::LOW,
            'platform' => $this->faker->randomElement([Platform::IOS, Platform::ANDROID, Platform::LARAVEL]),
            'last_issue_at' => now(),
        ];
    }
}

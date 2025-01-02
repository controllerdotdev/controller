<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use App\Models\Project;
use App\Enums\Platform;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->withWorkspace()->create();
    $this->project = Project::factory()->create([
        'workspace_id' => $this->user->currentWorkspace->id,
    ]);
});

it('can create a new issue', function () {

    $response = $this
        ->withToken($this->user->currentWorkspace->token)
        ->withHeader('project-id', $this->project->id)
        ->post(route('api.issues.store'), [
            'title' => 'New Issue',
            'description' => 'New Issue Description',
            'platform' => Platform::IOS->value,
        ]);

    $response->assertStatus(201);
});

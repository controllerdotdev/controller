<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use App\Models\ApiToken;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->withWorkspace()->create();
    $this->token = ApiToken::factory()->create([
        'workspace_id' => $this->user->current_workspace_id,
    ]);
});

it('can create a new issue', function () {
    $response = $this
        ->withToken($this->token->token)
        ->post(route('api.issues.store'), [
            'title' => 'New Issue',
            'description' => 'New Issue Description',
        ]);

    $response->assertStatus(201);
});

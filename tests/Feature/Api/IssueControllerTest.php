<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Issue;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IssueControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_issue()
    {
        // Arrange: Create a workspace
        $workspace = Workspace::factory()->create();

        // Act: Make a POST request to the store endpoint
        $response = $this->postJson(route('api.issues.store'), [
            'workspace_id' => $workspace->id,
        ]);

        // Assert: Check if the issue was created and response is correct
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workspace_id',
                    // Add other fields as necessary
                ],
            ]);

        $this->assertDatabaseHas('issues', [
            'workspace_id' => $workspace->id,
        ]);
    }
}

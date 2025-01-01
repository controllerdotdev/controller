<?php

declare(strict_types=1);

namespace App\Http\Controllers\PrivateApi;

use App\Http\Resources\IssueResource;

use Illuminate\Http\Request;

use App\Http\Requests\Issue\CreateRequest;

use App\Models\Issue;

use App\Enums\Issue\Status;
use App\Enums\Issue\Priority;

class IssueController extends Controller
{
    public function store(CreateRequest $request)
    {
        $issue = Issue::create([
            'workspace_id' => $request->workspace->id,
            'project_id' => $request->project->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => Status::OPEN,
            'priority' => Priority::LOW,
            'platform' => $request->platform,
            'last_issue_at' => now(),
        ]);

        return response()->json(new IssueResource($issue), 201);
    }
}

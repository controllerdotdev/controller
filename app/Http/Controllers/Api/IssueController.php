<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\IssueResource;

use Illuminate\Http\Request;

use App\Http\Requests\Issue\CreateRequest;
use Illuminate\Http\Response;


use App\Services\IssueService;


use App\Models\Issue;

use App\Enums\Issue\Status;
use App\Enums\Issue\Priority;

class IssueController extends Controller
{
    public function __construct(
        private readonly IssueService $issueService
    ) {}

    public function index(Request $request)
    {
        $issues = Issue::where('workspace_id', $request->workspace->id)
            ->where('project_id', $request->project->id)
            ->latest()
            ->paginate(config('app.pagination.default'));

        return IssueResource::collection($issues);
    }

    public function store(CreateRequest $request)
    {
        $issue = $this->issueService->process(
            $request->workspace,
            $request->project,
            $request->validated()
        );

        return response()->json([
            'status' => 'success',
            'data' => [
                'issue_id' => $issue->id,
                'issue_url' => route('issues.show', $issue->id)
            ]
        ], Response::HTTP_CREATED);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\IssueResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\Issue\CreateRequest;

use App\Models\Issue;

class IssueController extends Controller
{
    public function store(CreateRequest $request)
    {
        $issue = Issue::create([
            'workspace_id' => $request->workspace->id,
        ]);

        return response()->json(new IssueResource($issue), 201);
    }
}

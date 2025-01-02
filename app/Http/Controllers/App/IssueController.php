<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\Issue\CreateRequest;
use App\Http\Requests\Issue\UpdateRequest;

use App\Models\Issue;

use Inertia\Inertia;
use Inertia\Response;

class IssueController extends Controller
{
    public function index(Request $request): Response
    {
        $workspace = $request->user()->currentWorkspace;

        $query = Issue::where('workspace_id', $workspace->id)
            ->latest();

        // search
        if ($request->q) {
            // $query->where(function ($query) use ($request) {
            //     $query->where('link', 'LIKE', '%' . $request->q . '%');
            //     $query->orWhere('url', 'LIKE', '%' . $request->q . '%');
            //     $query->orWhere('utm_source', 'LIKE', '%' . $request->q . '%');
            //     $query->orWhere('utm_medium', 'LIKE', '%' . $request->q . '%');
            //     $query->orWhere('utm_campaign', 'LIKE', '%' . $request->q . '%');
            //     $query->orWhere('utm_term', 'LIKE', '%' . $request->q . '%');
            //     $query->orWhere('utm_content', 'LIKE', '%' . $request->q . '%');
            // });
        }

        $tabler = $query->paginate(config('app.pagination.default'));

        return Inertia::render('Issue/Index/Index', [
            'table' => $tabler,
            'hasData' => Issue::where('workspace_id', $workspace->id)->exists(),
        ]);
    }

    public function show($id, Request $request)
    {
        $workspace = $request->user()->currentWorkspace;

        $issue = Issue::where('workspace_id', $workspace->id)
            ->where('id', $id)
            ->with('issue_events')
            ->firstOrFail();

        return Inertia::render('Issue/Show/Index', [
            'issue' => $issue,
        ]);
    }

    public function destroy($id, Request $request)
    {
        $workspace = $request->user()->currentWorkspace;

        $issue = Issue::where('workspace_id', $workspace->id)->where('id', $id)->firstOrFail();
        $issue->delete();

        session()->flash('flash.banner', 'Issue deleted successfully.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('issues.index'));
    }
}

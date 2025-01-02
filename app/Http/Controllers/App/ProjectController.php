<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\Project;
use App\Enums\Platform;
class ProjectController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Project/Create', [
            'platforms' => Platform::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // DB::beginTransaction();

        // try {
            $user = auth()->user();
            $workspace = $user->currentWorkspace;

            Project::create([
                'workspace_id' => $workspace->id,
                'name' => $request->name,
                'platform' => $request->platform,
            ]);

            DB::commit();

            return redirect(route('issues.index'));
        // } catch (\Exception $e) {
        //     Log::error($e);
        //     DB::rollBack();

        //     session()->flash('flash.banner', 'Error creating workspace');
        //     session()->flash('flash.bannerStyle', 'danger');
        //     return back();
        // }
    }

    public function setCurrentWorkspace(Request $request)
    {
        $workspace = Workspace::findOrFail($request->workspace_id);

        if (!$request->user()->switchWorkspace($workspace)) {
            abort(403);
        }

        return Inertia::location(route('issues.index'));
    }
}

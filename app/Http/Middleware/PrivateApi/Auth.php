<?php

declare(strict_types=1);

namespace App\Http\Middleware\PrivateApi;

use Closure;
use Illuminate\Http\Request;

use App\Models\Workspace;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // check if the token is present
        $token = $request->header('authorization') ? $request->bearerToken() : null;
        if(!$token) {
            return response()->json(['status' => 'error', 'message' => 'Token not provided'], 401);
        }

        // get the token
        $workspace = Workspace::where('token', $token)->first();
        if (!$workspace) {
            return response()->json(['status' => 'error', 'message' => 'Invalid token'], 401);
        }

        // get project
        $project = $workspace->projects()->where('id', $request->header('project-id'))->first();
        if (!$project) {
            return response()->json(['status' => 'error', 'message' => 'Invalid project'], 401);
        }

        $request->merge([
            'workspace' => $workspace,
            'project' => $project,
        ]);

        return $next($request);
    }
}

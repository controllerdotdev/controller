<?php

declare(strict_types=1);

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Token not provided'], Response::HTTP_UNAUTHORIZED);
        }

        // get the token
        $workspace = Workspace::where('token', $token)->first();
        if (!$workspace) {
            return response()->json(['status' => 'error', 'message' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        // get project
        $project = $workspace->projects()->where('id', $request->header('project-id'))->first();
        if (!$project) {
            return response()->json(['status' => 'error', 'message' => 'Invalid project'], Response::HTTP_UNAUTHORIZED);
        }

        $request->merge([
            'workspace' => $workspace,
            'project' => $project,
        ]);

        return $next($request);
    }
}

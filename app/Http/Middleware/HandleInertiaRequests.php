<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => function () use ($request) {
                    if (! $request->user()) {
                        return;
                    }

                    $currentWorkspace = $request->user()->current_workspace_id ? $request->user()->currentWorkspace : null;
                    $currentWorkspace ? $currentWorkspace->role = $request->user()->workspaceRole($currentWorkspace) : null;

                    return array_merge($request->user()->toArray(), array_filter([
                        'current_workspace' => $currentWorkspace,
                        'workspaces' => $request->user()->workspaces,
                    ]));
                },
            ],
            'flash' => $request->session()->get('flash', []),
            'env' => config('app.env'),
            'locale' => app()->getLocale(),
        ];
    }
}

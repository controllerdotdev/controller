<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\App\WorkspaceController;
use App\Http\Controllers\App\MediaController;
use App\Http\Controllers\App\IssueController;

// setting
use App\Http\Controllers\App\Setting\AccountController;
use App\Http\Controllers\App\Setting\WorkspaceController as SettingWorkspaceController;

Route::group(
    [
        'middleware' => [
            'auth',
            'verified',
            'set-workspace'
        ],
    ],
    function () {

        // workspaces
        Route::get('/workspaces/create', [WorkspaceController::class, 'create'])->name('workspaces.create');
        Route::post('/workspaces', [WorkspaceController::class, 'store'])->name('workspaces.store');
        Route::put('/workspaces/update-current', [WorkspaceController::class, 'setCurrentWorkspace'])->name('workspaces.update-current');

        // issues
        Route::get('/issues/{id?}', [IssueController::class, 'index'])->name('issues.index');
        Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');
        Route::put('/issues/{id}', [IssueController::class, 'update'])->name('issues.update');
        Route::delete('/issues/{id}', [IssueController::class, 'destroy'])->name('issues.destroy');

        // medias
        Route::get('/medias/{id}/download', [MediaController::class, 'download'])->name('medias.download')->withoutMiddleware('*');
        Route::post('/medias', [MediaController::class, 'store'])->name('medias.store');
        Route::post('/medias/sort', [MediaController::class, 'sort'])->name('medias.sort');
        Route::post('/medias/{modelId}/thumbnail/{id}', [MediaController::class, 'thumbnail'])->name('medias.thumbmail');
        Route::delete('/medias/{modelId}/{id}', [MediaController::class, 'destroy'])->name('medias.destroy');

        // settings
        Route::prefix('settings')->group(function () {

            // account
            Route::get('/account', [AccountController::class, 'edit'])->name('setting.account.edit')->withoutMiddleware(['set-store']);
            Route::post('/account', [AccountController::class, 'update'])->name('setting.account.update')->withoutMiddleware(['set-store']);
            Route::delete('/account/photo', [AccountController::class, 'deletePhoto'])->name('setting.account.photo.destroy')->withoutMiddleware(['set-store']);

            // workspace
            Route::get('/workspace', [SettingWorkspaceController::class, 'edit'])->name('setting.workspace.edit');
            Route::put('/workspace', [SettingWorkspaceController::class, 'update'])->name('setting.workspace.update');
            Route::delete('/workspace/photo', [SettingWorkspaceController::class, 'deleteLogo'])->name('setting.workspace.logo.destroy');
        });
    }
);

require __DIR__ . '/auth.php';

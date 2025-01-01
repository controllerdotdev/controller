<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrivateApi\IssueController;

Route::group(
    [
        'middleware' => ['private-api.auth'],
        'prefix' => 'private-api',
    ],
    function () {

        // issues
        Route::post('/projects/issues', [IssueController::class, 'store'])->name('private-api.issues.store');
    }
);

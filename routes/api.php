<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\IssueController;

Route::group(
    ['middleware' => ['api.auth']],
    function () {

        // issues
        Route::post('/issues', [IssueController::class, 'store'])->name('api.issues.store');
    }
);

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['public-api.auth'],
        'prefix' => 'v1',
    ],
    function () {

    }
);

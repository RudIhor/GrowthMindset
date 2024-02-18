<?php

use Illuminate\Support\Facades\Route;
use Modules\Author\app\Http\Controllers\Api\AuthorController;

Route::middleware(['auth:api', 'role:admin'])->group(function() {
    Route::apiResource('authors', AuthorController::class);
});

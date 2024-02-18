<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\app\Http\Controllers\Api\CategoryController;

Route::middleware(['auth:api', 'role:admin'])->group(function() {
    Route::apiResource('categories',CategoryController::class);
});

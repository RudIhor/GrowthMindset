<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DecisiveStatementController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
        Route::post('refresh', 'refresh')->name('refresh');
        Route::get('me', 'me')->name('me');
    });
});

Route::middleware(['auth:api', 'role:admin'])->group(function() {
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('quotes', QuoteController::class);
    Route::apiResource('decisive-statements', DecisiveStatementController::class);
});

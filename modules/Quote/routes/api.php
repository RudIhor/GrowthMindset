<?php

use Illuminate\Support\Facades\Route;
use Modules\Quote\app\Http\Controllers\Api\QuoteController;

Route::middleware(['auth:api', 'role:admin'])->group(function() {
    Route::apiResource('quotes', QuoteController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Quote\app\Http\Controllers\Api\QuoteController;

Route::middleware(['auth:api'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('quotes', QuoteController::class);
    });
});

Route::middleware(['auth:application'])->group(function () {
    Route::get('/quotes/category/{category}', [QuoteController::class, 'getRandomQuoteFromCategoryWithTranslation'])->name(
        'quotes.category-quote-with-translation'
    );
});

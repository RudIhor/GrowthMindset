<?php

namespace App\Http\Controllers\Api;

use App\Actions\Quote\CreateQuoteAction;
use App\Actions\Quote\DeleteQuoteAction;
use App\Actions\Quote\UpdateQuoteAction;
use App\DTOs\Quote\StoreQuoteDTO;
use App\DTOs\Quote\UpdateQuoteDTO;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;

class QuoteController extends Controller
{
    public function __construct(private readonly QuoteService $quoteService)
    {
    }

    /**
     * @return PaginatedDataCollection
     */
    public function index(): PaginatedDataCollection
    {
        return $this->quoteService->getQuotes();
    }

    /**
     * @param Quote $quote
     * @return \App\DTOs\Quote\StoreQuoteDTO
     */
    public function show(Quote $quote): StoreQuoteDTO
    {
        return $this->quoteService->getQuote($quote);
    }

    /**
     * @param StoreQuoteDTO $quoteDTO
     * @param CreateQuoteAction $createQuoteAction
     * @return Quote
     */
    public function store(StoreQuoteDTO $quoteDTO, CreateQuoteAction $createQuoteAction): Quote
    {
        return $createQuoteAction->execute($quoteDTO);
    }

    /**
     * @param Quote $quote
     * @param UpdateQuoteDTO $quoteDTO
     * @param UpdateQuoteAction $updateQuoteAction
     * @return Quote
     */
    public function update(Quote $quote, UpdateQuoteDTO $quoteDTO, UpdateQuoteAction $updateQuoteAction): Quote
    {
        return $updateQuoteAction->execute($quoteDTO, $quote);
    }

    /**
     * @param Quote $quote
     * @param DeleteQuoteAction $deleteQuoteAction
     * @return JsonResponse
     */
    public function destroy(Quote $quote, DeleteQuoteAction $deleteQuoteAction): JsonResponse
    {
        return response()->json([
            'message' => $deleteQuoteAction->execute($quote) ? 'success' : 'fail',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Http\Requests\Quote\UpdateQuoteRequest;
use App\Http\Resources\Quote\QuoteCollection;
use App\Http\Resources\Quote\QuoteResource;
use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
    public function __construct(private readonly QuoteService $quoteService)
    {
    }

    /**
     * @return \App\Http\Resources\Quote\QuoteCollection
     */
    public function index(): QuoteCollection
    {
        return $this->quoteService->getQuotes();
    }

    /**
     * @param \App\Models\Quote $quote
     * @return \App\Http\Resources\Quote\QuoteResource
     */
    public function show(Quote $quote): QuoteResource
    {
        return $this->quoteService->getQuote($quote);
    }

    /**
     * @param \App\Http\Requests\Quote\StoreQuoteRequest $request
     * @return \App\Models\Quote
     */
    public function store(StoreQuoteRequest $request): Quote
    {
        return $this->quoteService->create($request);
    }

    /**
     * @param \App\Models\Quote $quote
     * @param \App\Http\Requests\Quote\UpdateQuoteRequest $request
     * @return \App\Models\Quote
     */
    public function update(Quote $quote, UpdateQuoteRequest $request): Quote
    {
        return $this->quoteService->update($request, $quote);
    }

    /**
     * @param \App\Models\Quote $quote
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Quote $quote): JsonResponse
    {
        return response()->json([
            'message' => $this->quoteService->delete($quote) ? 'success' : 'fail',
        ]);
    }
}

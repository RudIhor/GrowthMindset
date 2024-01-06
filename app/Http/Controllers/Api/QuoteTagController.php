<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteTag\StoreQuoteTagRequest;
use App\Http\Resources\Quote\QuoteCollection;
use App\Http\Resources\Quote\QuoteResource;
use App\Http\Resources\QuoteTagCollection;
use App\Http\Resources\QuoteTagResource;
use App\Models\Quote;
use App\Models\QuoteTag;
use App\Services\QuoteTagService;
use Illuminate\Http\JsonResponse;

class QuoteTagController extends Controller
{
    public function __construct(private readonly QuoteTagService $quoteTagService)
    {
    }

    /**
     * @return \App\Http\Resources\Quote\QuoteCollection
     */
    public function index(): QuoteCollection
    {
        return $this->quoteTagService->getQuoteTags();
    }

    /**
     * @param \App\Models\Quote $quote
     * @return \App\Http\Resources\Quote\QuoteResource
     */
    public function show(Quote $quote): QuoteResource
    {
        return $this->quoteTagService->getQuoteTag($quote);
    }

    /**
     * @param \App\Http\Requests\QuoteTag\StoreQuoteTagRequest $request
     * @return \App\Models\QuoteTag
     */
    public function store(StoreQuoteTagRequest $request): QuoteTag
    {
        return $this->quoteTagService->create($request);
    }

    /**
     * @param \App\Models\QuoteTag $quoteTag
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(QuoteTag $quoteTag): JsonResponse
    {
        return response()->json([
            'message' => $this->quoteTagService->delete($quoteTag) ? 'success' : 'fail',
        ]);
    }
}

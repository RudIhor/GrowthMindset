<?php

namespace App\Services;

use App\Http\Requests\QuoteTag\StoreQuoteTagRequest;
use App\Http\Resources\Quote\QuoteCollection;
use App\Http\Resources\Quote\QuoteResource;
use App\Models\Quote;
use App\Models\QuoteTag;

class QuoteTagService
{
    /**
     * @return \App\Http\Resources\Quote\QuoteCollection
     */
    public function getQuoteTags(): QuoteCollection
    {
        return new QuoteCollection(Quote::paginate());
    }

    /**
     * @param \App\Models\Quote $quote
     * @return \App\Http\Resources\Quote\QuoteResource
     */
    public function getQuoteTag(Quote $quote): QuoteResource
    {
        return new QuoteResource($quote);
    }

    /**
     * @param \App\Http\Requests\QuoteTag\StoreQuoteTagRequest $request
     * @return \App\Models\QuoteTag
     */
    public function create(StoreQuoteTagRequest $request): QuoteTag
    {
        return QuoteTag::create($request->validated());
    }

    /**
     * @param \App\Models\QuoteTag $quoteTag
     * @return bool|null
     */
    public function delete(QuoteTag $quoteTag): ?bool
    {
        return $quoteTag->delete();
    }
}

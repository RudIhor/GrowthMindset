<?php

namespace App\Actions\Quote;

use App\DTOs\Quote\StoreQuoteDTO;
use App\Models\Quote;

class CreateQuoteAction
{
    /**
     * Creates a quote.
     *
     * @param StoreQuoteDTO $quoteDTO
     * @return Quote
     */
    public function execute(StoreQuoteDTO $quoteDTO): Quote
    {
        return Quote::query()->create($quoteDTO->toArray());
    }
}

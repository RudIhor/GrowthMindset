<?php

namespace App\Actions\Quote;

use App\DTOs\Quote\UpdateQuoteDTO;
use App\Models\Quote;

class UpdateQuoteAction
{
    /**
     * Updates a quote.
     *
     * @param UpdateQuoteDTO $quoteDTO
     * @param Quote $quote
     * @return Quote
     */
    public function execute(UpdateQuoteDTO $quoteDTO, Quote $quote): Quote
    {
        $quote->update(array_filter($quoteDTO->toArray()));

        return $quote;
    }
}

<?php

namespace Modules\Quote\app\Actions;

use Modules\Quote\app\DTOs\UpdateQuoteDTO;
use Modules\Quote\app\Models\Quote;

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

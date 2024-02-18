<?php

namespace Modules\Quote\app\Actions;

use Modules\Quote\app\DTOs\StoreQuoteDTO;
use Modules\Quote\app\Models\Quote;

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

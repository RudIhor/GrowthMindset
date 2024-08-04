<?php

namespace Modules\Quote\app\Actions;

use Modules\Category\app\Models\Category;
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
        $quote = Quote::query()->create($quoteDTO->toArray());
        Category::find($quoteDTO->category_id)->quotes()->save($quote);

        return $quote;
    }
}

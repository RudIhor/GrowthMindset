<?php

namespace App\Actions\Quote;

use App\Models\Quote;

class DeleteQuoteAction
{
    /**
     * Deletes a quote.
     *
     * @param Quote $quote
     * @return bool|null
     */
    public function execute(Quote $quote): ?bool
    {
        return $quote->delete();
    }
}

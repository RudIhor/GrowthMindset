<?php

namespace Modules\Quote\app\Actions;

use Modules\Quote\app\Models\Quote;

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

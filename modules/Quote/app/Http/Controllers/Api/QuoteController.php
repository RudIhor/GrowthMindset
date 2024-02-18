<?php

namespace Modules\Quote\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Quote\app\Actions\CreateQuoteAction;
use Modules\Quote\app\Actions\DeleteQuoteAction;
use Modules\Quote\app\Actions\UpdateQuoteAction;
use Modules\Quote\app\DTOs\StoreQuoteDTO;
use Modules\Quote\app\DTOs\UpdateQuoteDTO;
use Modules\Quote\app\Models\Quote;
use Modules\Quote\app\Services\QuoteService;
use Spatie\LaravelData\PaginatedDataCollection;

class QuoteController extends Controller
{
    public function __construct(private readonly QuoteService $quoteService)
    {
    }

    /**
     * @return PaginatedDataCollection
     */
    public function index(): PaginatedDataCollection
    {
        return $this->quoteService->getQuotes();
    }

    /**
     * @param Quote $quote
     * @return \Modules\Quote\app\DTOs\StoreQuoteDTO
     */
    public function show(Quote $quote): StoreQuoteDTO
    {
        return $this->quoteService->getQuote($quote);
    }

    /**
     * @param StoreQuoteDTO $quoteDTO
     * @param CreateQuoteAction $createQuoteAction
     * @return Quote
     */
    public function store(StoreQuoteDTO $quoteDTO, CreateQuoteAction $createQuoteAction): Quote
    {
        return $createQuoteAction->execute($quoteDTO);
    }

    /**
     * @param Quote $quote
     * @param UpdateQuoteDTO $quoteDTO
     * @param UpdateQuoteAction $updateQuoteAction
     * @return Quote
     */
    public function update(Quote $quote, UpdateQuoteDTO $quoteDTO, UpdateQuoteAction $updateQuoteAction): Quote
    {
        return $updateQuoteAction->execute($quoteDTO, $quote);
    }

    /**
     * @param Quote $quote
     * @param DeleteQuoteAction $deleteQuoteAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote, DeleteQuoteAction $deleteQuoteAction): Response
    {
        $deleteQuoteAction->execute($quote);

        return response()->noContent();
    }
}

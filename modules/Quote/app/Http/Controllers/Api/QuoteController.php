<?php

namespace Modules\Quote\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\app\Models\Category;
use Modules\Quote\app\Actions\CreateQuoteAction;
use Modules\Quote\app\Actions\DeleteQuoteAction;
use Modules\Quote\app\Actions\UpdateQuoteAction;
use Modules\Quote\app\DTOs\StoreQuoteDTO;
use Modules\Quote\app\DTOs\UpdateQuoteDTO;
use Modules\Quote\app\Http\Resources\QuoteCollection;
use Modules\Quote\app\Http\Resources\QuoteResource;
use Modules\Quote\app\Models\Quote;
use Modules\Quote\app\Services\QuoteService;

class QuoteController extends Controller
{
    public function __construct(private readonly QuoteService $quoteService)
    {
    }

    /**
     * @return QuoteCollection
     */
    public function index(): QuoteCollection
    {
        return $this->quoteService->getQuotes();
    }

    /**
     * @param Quote $quote
     * @return QuoteResource
     */
    public function show(Quote $quote): QuoteResource
    {
        return $this->quoteService->getQuote($quote);
    }

    /**
     * @param int $categoryId
     * @param Request $request
     * @return string
     */
    public function getRandomQuoteFromCategoryWithTranslation(int $categoryId, Request $request): string
    {
        $category = Category::findOrFail($categoryId);
        if ($category->quotes()->count() === 0) {
            abort(404, 'There is no quotes for such category.');
        }

        return $this->quoteService->getRandomQuoteFromCategoryWithTranslation($category, $request->get('language_code'));
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
     * @return Response
     */
    public function destroy(Quote $quote, DeleteQuoteAction $deleteQuoteAction): Response
    {
        $deleteQuoteAction->execute($quote);

        return response()->noContent();
    }
}

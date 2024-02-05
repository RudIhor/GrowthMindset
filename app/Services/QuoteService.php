<?php

namespace App\Services;

use App\Azure\Services\TranslatorService;
use App\Enums\LanguageCode;
use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Http\Requests\Quote\UpdateQuoteRequest;
use App\Http\Resources\Quote\QuoteCollection;
use App\Http\Resources\Quote\QuoteResource;
use App\Models\Quote;

class QuoteService
{
    public function __construct(protected TranslatorService $translatorService)
    {
    }

    public function getRandomQuoteMessage(string $languageCode = 'en'): string
    {
        /** @var Quote $quote */
        $quote = Quote::inRandomOrder()->first();

        $text = $quote->content;
        $authorName = $quote->author->full_name ?? '😉';
        $categoryName = $quote->category->name;

        if (LanguageCode::isTranslationable($languageCode)) {
            $authorName = $this->translatorService->translate($authorName, $languageCode);
            $categoryName = $this->translatorService->translate($categoryName, $languageCode);
            if ($quote->category_id !== 12) {
                $text = $quote->author?->full_name . ' said* ' . $quote->content;
                $text = $this->translatorService->translate($text, $languageCode);
                $text = str_replace('*', '', substr($text, (int)strpos($text, '*') + 2));
            } else {
                $text = $this->translatorService->translate($text, $languageCode);
            }
        }

        return sprintf("*%s*\n✍️: %s\n🗂️: %s", $text, $authorName, $categoryName);
    }

    /**
     * @return \App\Http\Resources\Quote\QuoteCollection
     */
    public function getQuotes(): QuoteCollection
    {
        return new QuoteCollection(Quote::paginate(25));
    }

    /**
     * @param \App\Models\Quote $quote
     * @return \App\Http\Resources\Quote\QuoteResource
     */
    public function getQuote(Quote $quote): QuoteResource
    {
        return new QuoteResource($quote);
    }

    /**
     * @param \App\Http\Requests\Quote\StoreQuoteRequest $request
     * @return \App\Models\Quote
     */
    public function create(StoreQuoteRequest $request): Quote
    {
        return Quote::create($request->validated());
    }

    /**
     * @param \App\Http\Requests\Quote\UpdateQuoteRequest $request
     * @param \App\Models\Quote $quote
     * @return \App\Models\Quote
     */
    public function update(UpdateQuoteRequest $request, Quote $quote): Quote
    {
        $quote->update($request->validated());

        return $quote;
    }

    /**
     * @param \App\Models\Quote $quote
     * @return bool|null
     */
    public function delete(Quote $quote): ?bool
    {
        return $quote->delete();
    }
}

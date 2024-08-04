<?php

namespace Modules\Quote\app\Services;

use App\Azure\Services\TranslatorService;
use Modules\Author\app\Models\Author;
use Modules\Category\app\Models\Category;
use Modules\Quote\app\DTOs\StoreQuoteDTO;
use Modules\Quote\app\Models\Quote;
use Modules\Telegram\app\Enums\LanguageCode;
use Spatie\LaravelData\PaginatedDataCollection;

class QuoteService
{
    public function __construct(protected TranslatorService $translatorService)
    {
    }

    public function getRandomQuoteMessage(string $languageCode = 'en'): string
    {
        /** @var Quote $quote */
        $quote = Quote::query()->inRandomOrder()->first();
        $text = $quote->content;
        $authorName = $this->getAuthorName($quote->author);

        if (LanguageCode::isTranslationable($languageCode)) {
            if ($quote->category_id !== 12) {
                $text = $quote->author?->full_name . ' said* ' . $quote->content;
                $text = $this->translatorService->translate($text, $languageCode);
                $text = str_replace('*', '', substr($text, (int)strpos($text, '*') + 2));
            } else {
                $text = $this->translatorService->translate($text, $languageCode);
            }
        }

        return sprintf("%s\n\n%s", $text, $authorName);
    }

    public function getRandomQuoteFromCategoryWithTranslation(Category $category, string $languageCode): string
    {
        $quote = Quote::query()->where('category_id', $category->id)->inRandomOrder()->first();
        $authorName = $this->getAuthorName($quote->author);
        $text = $this->translatorService->translate($quote->content, $languageCode);

        return sprintf("%s\n\n%s", $text, $authorName);
    }

    /**
     * @return PaginatedDataCollection
     */
    public function getQuotes(): PaginatedDataCollection
    {
        return StoreQuoteDTO::collection(Quote::query()->paginate(25));
    }

    /**
     * @param Quote $quote
     * @return StoreQuoteDTO
     */
    public function getQuote(Quote $quote): StoreQuoteDTO
    {
        return StoreQuoteDTO::from($quote);
    }

    /**
     * Get author's name.
     *
     * @param Quote $quote
     * @return string
     */
    private function getAuthorName(?Author $author): string
    {
        if (!empty($author->full_name)) {
            return '© ' . $author->full_name;
        }

        return '';
    }
}

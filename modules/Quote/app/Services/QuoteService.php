<?php

namespace Modules\Quote\app\Services;

use App\Azure\Services\TranslatorService;
use Modules\Author\app\Models\Author;
use Modules\Category\app\Models\Category;
use Modules\Quote\app\Http\Resources\QuoteCollection;
use Modules\Quote\app\Http\Resources\QuoteResource;
use Modules\Quote\app\Models\Quote;
use Modules\Telegram\app\Enums\LanguageCode;

class QuoteService
{
    public function __construct(protected TranslatorService $translatorService)
    {
    }

    /**
     * @param string $languageCode
     * @return string
     */
    public function getRandomQuoteMessage(string $languageCode = 'en'): string
    {
        /** @var Quote $quote */
        $quote = Quote::query()->inRandomOrder()->first();

        $separator = ':> ';
        $text = 'This is a famous quote' . $separator . $quote->content;
        $authorName = $this->getAuthorName($quote->author);

        if (LanguageCode::isTranslationable($languageCode)) {
            $text = $this->translatorService->translate($text, $languageCode);
        }

        return sprintf("%s\n\n%s", explode($separator, $text)[1], $authorName);
    }

    public function getRandomQuoteFromCategoryWithTranslation(Category $category, string $languageCode): string
    {
        $quote = $category->quotes()->inRandomOrder()->first();
        $authorName = $this->getAuthorName($quote->author);
        $text = $this->translatorService->translate($quote->content, $languageCode);

        return sprintf("%s\n\n%s", $text, $authorName);
    }

    /**
     * @return QuoteCollection
     */
    public function getQuotes(): QuoteCollection
    {
        return QuoteCollection::make(Quote::query()->paginate(25));
    }

    /**
     * @param Quote $quote
     * @return QuoteResource
     */
    public function getQuote(Quote $quote): QuoteResource
    {
        return new QuoteResource($quote);
    }

    /**
     * Get author's name.
     *
     * @param Author|null $author
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

<?php

namespace App\DTOs\Quote;

use Spatie\LaravelData\Data;

class UpdateQuoteDTO extends Data
{
    public string $content;
    public ?int $author_id;
    public ?int $category_id;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'content' => ['min:5'],
            'author_id' => ['nullable', 'integer', 'exists:authors,id'],
            'category_id' => ['integer', 'exists:categories,id'],
        ];
    }
}

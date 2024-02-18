<?php

namespace Modules\Quote\app\DTOs;

use Spatie\LaravelData\Data;

class StoreQuoteDTO extends Data
{
    public ?int $id;
    public string $content;
    public ?int $author_id;
    public int $category_id;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'content' => ['required', 'min:5'],
            'author_id' => ['integer', 'exists:authors,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}

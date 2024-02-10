<?php

namespace App\DTOs\DecisiveStatement;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UpdateDecisiveStatementDTO extends Data
{
    public ?string $content;
    public ?int $category_id;

    /**
     * @param ValidationContext $context
     * @return array<string, string[]>
     */
    public static function rules(ValidationContext $context): array
    {
        return [
            'content' => ['min:5'],
            'category_id' => ['exists:categories,id'],
        ];
    }
}

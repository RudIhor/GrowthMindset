<?php

namespace Modules\Author\app\DTOs;

use Spatie\LaravelData\Data;

class UpdateAuthorDTO extends Data
{
    public ?string $first_name;
    public ?string $last_name;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'first_name' => ['min:1', 'max:255'],
            'last_name' => ['min:1', 'max:255'],
        ];
    }
}

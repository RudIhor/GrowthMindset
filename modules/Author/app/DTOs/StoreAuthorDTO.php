<?php

namespace Modules\Author\app\DTOs;

use Spatie\LaravelData\Data;

class StoreAuthorDTO extends Data
{
    public ?int $id;
    public string $first_name;
    public ?string $last_name;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['min:2', 'max:255'],
        ];
    }
}

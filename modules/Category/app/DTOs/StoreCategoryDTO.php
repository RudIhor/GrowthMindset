<?php

namespace Modules\Category\app\DTOs;

use Spatie\LaravelData\Data;

class StoreCategoryDTO extends Data
{
    public ?int $id;
    public string $name;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255', 'unique:categories,name'],
        ];
    }
}

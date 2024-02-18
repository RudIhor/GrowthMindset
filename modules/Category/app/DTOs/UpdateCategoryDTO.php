<?php

namespace Modules\Category\app\DTOs;

use Spatie\LaravelData\Data;

class UpdateCategoryDTO extends Data
{
    public string $name;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'name' => ['min:3', 'max:255', 'unique:categories,name'],
        ];
    }
}

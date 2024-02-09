<?php

namespace App\Actions\Category;

use App\DTOs\Category\StoreCategoryDTO;
use App\Models\Category;

class CreateCategoryAction
{
    /**
     * Creates a category.
     *
     * @param StoreCategoryDTO $categoryDTO
     * @return Category
     */
    public function execute(StoreCategoryDTO $categoryDTO): Category
    {
        return Category::query()->create($categoryDTO->toArray());
    }
}

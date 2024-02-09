<?php

namespace App\Actions\Category;

use App\DTOs\Category\UpdateCategoryDTO;
use App\Models\Category;

class UpdateCategoryAction
{
    /**
     * Updates a category.
     *
     * @param UpdateCategoryDTO $categoryDTO
     * @param Category $category
     * @return Category
     */
    public function execute(UpdateCategoryDTO $categoryDTO, Category $category): Category
    {
        $category->update(array_filter($categoryDTO->toArray()));

        return $category;
    }
}

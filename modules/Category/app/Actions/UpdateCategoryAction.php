<?php

namespace Modules\Category\app\Actions;

use Modules\Category\app\DTOs\UpdateCategoryDTO;
use Modules\Category\app\Models\Category;

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

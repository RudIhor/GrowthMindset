<?php

namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategoryAction
{
    /**
     * Deletes a category.
     *
     * @param Category $category
     * @return bool|null
     */
    public function execute(Category $category): ?bool
    {
        return $category->delete();
    }
}

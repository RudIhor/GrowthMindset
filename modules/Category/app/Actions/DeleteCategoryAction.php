<?php

namespace Modules\Category\app\Actions;

use Modules\Category\app\Models\Category;

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

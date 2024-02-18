<?php

namespace Modules\Category\app\Actions;

use Modules\Category\app\DTOs\StoreCategoryDTO;
use Modules\Category\app\Models\Category;

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

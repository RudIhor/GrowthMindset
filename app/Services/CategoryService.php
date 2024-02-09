<?php

namespace App\Services;

use App\DTOs\Category\StoreCategoryDTO;
use App\Models\Category;
use Spatie\LaravelData\PaginatedDataCollection;

class CategoryService
{
    /**
     * @return PaginatedDataCollection
     */
    public function getCategories(): PaginatedDataCollection
    {
        return StoreCategoryDTO::collection(Category::query()->paginate(25));
    }

    /**
     * @param Category $category
     * @return StoreCategoryDTO
     */
    public function getCategory(Category $category): StoreCategoryDTO
    {
        return StoreCategoryDTO::from($category);
    }
}

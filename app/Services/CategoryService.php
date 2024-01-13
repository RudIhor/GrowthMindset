<?php

namespace App\Services;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class CategoryService
{
    /**
     * @return \App\Http\Resources\Category\CategoryCollection
     */
    public function getCategories(): CategoryCollection
    {
        return new CategoryCollection(Category::paginate(25));
    }

    /**
     * @param \App\Models\Category $category
     * @return \App\Http\Resources\Category\CategoryResource
     */
    public function getCategory(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * @param \App\Http\Requests\Category\StoreCategoryRequest $request
     * @return \App\Models\Category
     */
    public function create(StoreCategoryRequest $request): Category
    {
        return Category::create($request->validated());
    }

    /**
     * @param \App\Http\Requests\Category\UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \App\Models\Category
     */
    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->update($request->validated());

        return $category;
    }

    /**
     * @param \App\Models\Category $category
     * @return bool|null
     */
    public function delete(Category $category): ?bool
    {
        return $category->delete();
    }
}

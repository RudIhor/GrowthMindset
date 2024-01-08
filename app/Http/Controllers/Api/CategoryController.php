<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    /**
     * @return \App\Http\Resources\Category\CategoryCollection
     */
    public function index(): CategoryCollection
    {
        return $this->categoryService->getCategories();
    }

    /**
     * @param \App\Models\Category $category
     * @return \App\Http\Resources\Category\CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return $this->categoryService->getCategory($category);
    }

    /**
     * @param \App\Http\Requests\Category\StoreCategoryRequest $request
     * @return \App\Models\Category
     */
    public function store(StoreCategoryRequest $request): Category
    {
        return $this->categoryService->create($request);
    }

    /**
     * @param \App\Models\Category $category
     * @param \App\Http\Requests\Category\UpdateCategoryRequest $request
     * @return \App\Models\Category
     */
    public function update(Category $category, UpdateCategoryRequest $request): Category
    {
        return $this->categoryService->update($request, $category);
    }

    /**
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        return response()->json([
            'message' => $this->categoryService->delete($category) ? 'success' : 'fail'
        ]);
    }
}

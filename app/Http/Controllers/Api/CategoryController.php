<?php

namespace App\Http\Controllers\Api;

use App\Actions\Category\{CreateCategoryAction, DeleteCategoryAction, UpdateCategoryAction};
use App\DTOs\Category\{StoreCategoryDTO, UpdateCategoryDTO};
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    /**
     * @return PaginatedDataCollection
     */
    public function index(): PaginatedDataCollection
    {
        return $this->categoryService->getCategories();
    }

    /**
     * @param Category $category
     * @return StoreCategoryDTO
     */
    public function show(Category $category): StoreCategoryDTO
    {
        return $this->categoryService->getCategory($category);
    }

    /**
     * @param StoreCategoryDTO $categoryDTO
     * @param CreateCategoryAction $createCategoryAction
     * @return Category
     */
    public function store(StoreCategoryDTO $categoryDTO, CreateCategoryAction $createCategoryAction): Category
    {
        return $createCategoryAction->execute($categoryDTO);
    }

    /**
     * @param Category $category
     * @param UpdateCategoryDTO $categoryDTO
     * @param UpdateCategoryAction $updateCategoryAction
     * @return Category
     */
    public function update(Category $category, UpdateCategoryDTO $categoryDTO, UpdateCategoryAction $updateCategoryAction): Category
    {
        return $updateCategoryAction->execute($categoryDTO, $category);
    }

    /**
     * @param Category $category
     * @param DeleteCategoryAction $deleteCategoryAction
     * @return JsonResponse
     */
    public function destroy(Category $category, DeleteCategoryAction $deleteCategoryAction): JsonResponse
    {
        return response()->json([
            'message' => $deleteCategoryAction->execute($category) ? 'success' : 'fail'
        ]);
    }
}

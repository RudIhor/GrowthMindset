<?php

namespace Modules\Category\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Category\app\Actions\{UpdateCategoryAction};
use Modules\Category\app\Actions\CreateCategoryAction;
use Modules\Category\app\Actions\DeleteCategoryAction;
use Modules\Category\app\DTOs\{UpdateCategoryDTO};
use Modules\Category\app\DTOs\StoreCategoryDTO;
use Modules\Category\app\Models\Category;
use Modules\Category\app\Services\CategoryService;
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, DeleteCategoryAction $deleteCategoryAction): Response
    {
        $deleteCategoryAction->execute($category);

        return response()->noContent();
    }
}

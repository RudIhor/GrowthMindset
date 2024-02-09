<?php

namespace App\Http\Controllers\Api;

use App\Actions\Author\{CreateAuthorAction, DeleteAuthorAction, UpdateAuthorAction};
use App\DTOs\Author\{StoreAuthorDTO, UpdateAuthorDTO};
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;

class AuthorController extends Controller
{
    public function __construct(private readonly AuthorService $authorService)
    {
    }

    /**
     * @return PaginatedDataCollection
     */
    public function index(): PaginatedDataCollection
    {
        return $this->authorService->getAuthors();
    }

    /**
     * @param Author $author
     * @return \App\DTOs\Author\StoreAuthorDTO
     */
    public function show(Author $author): StoreAuthorDTO
    {
        return $this->authorService->getAuthor($author);
    }

    /**
     * @param StoreAuthorDTO $authorDTO
     * @param CreateAuthorAction $createAuthorAction
     * @return Builder|Model
     */
    public function store(StoreAuthorDTO $authorDTO, CreateAuthorAction $createAuthorAction): Model|Builder
    {
        return $createAuthorAction->execute($authorDTO);
    }

    /**
     * @param Author $author
     * @param UpdateAuthorDTO $authorDTO
     * @param UpdateAuthorAction $updateAuthorAction
     * @return Author
     */
    public function update(Author $author, UpdateAuthorDTO $authorDTO, UpdateAuthorAction $updateAuthorAction): Author
    {
        return $updateAuthorAction->execute($authorDTO, $author);
    }

    /**
     * @param Author $author
     * @param DeleteAuthorAction $deleteAuthorAction
     * @return JsonResponse
     */
    public function destroy(Author $author, DeleteAuthorAction $deleteAuthorAction): JsonResponse
    {
        return response()->json([
            'message' => $deleteAuthorAction->execute($author) ? 'success' : 'fail',
        ]);
    }
}

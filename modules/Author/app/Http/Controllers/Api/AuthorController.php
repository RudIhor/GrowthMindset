<?php

namespace Modules\Author\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Http\Response;
use Modules\Author\app\Actions\{UpdateAuthorAction};
use Modules\Author\app\Actions\CreateAuthorAction;
use Modules\Author\app\Actions\DeleteAuthorAction;
use Modules\Author\app\DTOs\{StoreAuthorDTO};
use Modules\Author\app\DTOs\UpdateAuthorDTO;
use Modules\Author\app\Models\Author;
use Modules\Author\app\Services\AuthorService;
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
     * @return \Modules\Author\app\DTOs\StoreAuthorDTO
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author, DeleteAuthorAction $deleteAuthorAction): Response
    {
        $deleteAuthorAction->execute($author);

        return response()->noContent();
    }
}

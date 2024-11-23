<?php

namespace Modules\Author\app\Services;

use Modules\Author\app\DTOs\Requests\AuthorRequestDTO;
use Modules\Author\app\DTOs\StoreAuthorDTO;
use Modules\Author\app\Models\Author;
use Spatie\LaravelData\PaginatedDataCollection;

class AuthorService
{
    /**
     * @return PaginatedDataCollection
     */
    public function getAuthors(AuthorRequestDTO $request): PaginatedDataCollection
    {
        return StoreAuthorDTO::collection(Author::query()
            ->when($request->first_name, fn($query) => $query->where('first_name', 'LIKE', "%$request->first_name%"))
            ->when($request->last_name, fn($query) => $query->where('last_name', 'LIKE', "%$request->last_name%"))
            ->paginate(25));
    }

    /**
     * @param Author $author
     * @return StoreAuthorDTO
     */
    public function getAuthor(Author $author): StoreAuthorDTO
    {
        return StoreAuthorDTO::from($author);
    }
}

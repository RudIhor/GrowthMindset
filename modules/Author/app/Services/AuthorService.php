<?php

namespace Modules\Author\app\Services;

use Modules\Author\app\DTOs\StoreAuthorDTO;
use Modules\Author\app\Models\Author;
use Spatie\LaravelData\PaginatedDataCollection;

class AuthorService
{
    /**
     * @return PaginatedDataCollection
     */
    public function getAuthors(): PaginatedDataCollection
    {
        return StoreAuthorDTO::collection(Author::query()->paginate(25));
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

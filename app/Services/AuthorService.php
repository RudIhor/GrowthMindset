<?php

namespace App\Services;

use App\DTOs\Author\StoreAuthorDTO;
use App\Models\Author;
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
     * @return \App\DTOs\Author\StoreAuthorDTO
     */
    public function getAuthor(Author $author): StoreAuthorDTO
    {
        return StoreAuthorDTO::from($author);
    }
}

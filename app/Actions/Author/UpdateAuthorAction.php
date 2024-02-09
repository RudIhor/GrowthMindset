<?php

namespace App\Actions\Author;

use App\DTOs\Author\UpdateAuthorDTO;
use App\Models\Author;

class UpdateAuthorAction
{
    /**
     * Updates an author
     *
     * @param UpdateAuthorDTO $authorDTO
     * @param Author $author
     * @return Author
     */
    public function execute(UpdateAuthorDTO $authorDTO, Author $author): Author
    {
        $author->update(array_filter($authorDTO->toArray()));

        return $author;
    }
}

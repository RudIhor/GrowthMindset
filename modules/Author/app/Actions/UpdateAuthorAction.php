<?php

namespace Modules\Author\app\Actions;

use Modules\Author\app\DTOs\UpdateAuthorDTO;
use Modules\Author\app\Models\Author;

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

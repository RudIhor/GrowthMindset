<?php

namespace App\Actions\Author;

use App\Models\Author;

class DeleteAuthorAction
{
    /**
     * Deletes an author
     *
     * @param Author $author
     * @return bool|null
     */
    public function execute(Author $author): ?bool
    {
        return $author->delete();
    }
}

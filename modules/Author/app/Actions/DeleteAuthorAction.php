<?php

namespace Modules\Author\app\Actions;

use Modules\Author\app\Models\Author;

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

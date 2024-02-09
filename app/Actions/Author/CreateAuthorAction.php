<?php

namespace App\Actions\Author;

use App\DTOs\Author\StoreAuthorDTO;
use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateAuthorAction
{
    /**
     * Creates an author
     *
     * @param StoreAuthorDTO $authorDTO
     * @return Model|Author|Builder
     */
    public function execute(StoreAuthorDTO $authorDTO): Model|Author|Builder
    {
        return Author::query()->create($authorDTO->toArray());
    }
}

<?php

namespace Modules\Author\app\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Author\app\DTOs\StoreAuthorDTO;
use Modules\Author\app\Models\Author;

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

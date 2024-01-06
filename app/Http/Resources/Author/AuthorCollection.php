<?php

namespace App\Http\Resources\Author;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @phpstan-ignore-next-line  */
        return parent::toArray($request);
    }
}

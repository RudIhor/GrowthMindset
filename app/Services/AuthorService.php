<?php

namespace App\Services;

use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AuthorService
{
    /**
     * @return \App\Http\Resources\Author\AuthorCollection
     */
    public function getAuthors(): AuthorCollection
    {
        return new AuthorCollection(Author::paginate(25));
    }

    /**
     * @param \App\Models\Author $author
     * @return \App\Http\Resources\Author\AuthorResource
     */
    public function getAuthor(Author $author): AuthorResource
    {
        return new AuthorResource($author);
    }

    /**
     * @param \App\Http\Requests\Author\StoreAuthorRequest $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function create(StoreAuthorRequest $request): Model|Builder
    {
        return Author::query()->create($request->validated());
    }

    /**
     * @param \App\Http\Requests\Author\UpdateAuthorRequest $request
     * @param \App\Models\Author $author
     * @return \App\Models\Author
     */
    public function update(UpdateAuthorRequest $request, Author $author): Author
    {
        $author->update($request->validated());

        return $author;
    }

    /**
     * @param \App\Models\Author $author
     * @return bool|null
     */
    public function delete(Author $author): ?bool
    {
        return $author->delete();
    }
}

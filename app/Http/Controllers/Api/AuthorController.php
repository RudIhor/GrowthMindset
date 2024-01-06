<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct(private readonly AuthorService $authorService)
    {
    }

    /**
     * @return \App\Http\Resources\Author\AuthorCollection
     */
    public function index(): AuthorCollection
    {
        return $this->authorService->getAuthors();
    }

    /**
     * @param \App\Models\Author $author
     * @return \App\Http\Resources\Author\AuthorResource
     */
    public function show(Author $author): AuthorResource
    {
        return $this->authorService->getAuthor($author);
    }

    /**
     * @param \App\Http\Requests\Author\StoreAuthorRequest $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(StoreAuthorRequest $request): Model|Builder
    {
        return $this->authorService->create($request);
    }

    /**
     * @param \App\Http\Requests\Author\UpdateAuthorRequest $request
     * @param \App\Models\Author $author
     * @return \App\Models\Author
     */
    public function update(Author $author, UpdateAuthorRequest $request): Author
    {
        return $this->authorService->update($request, $author);
    }

    /**
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        return response()->json([
            'message' => $this->authorService->delete($author) ? 'success' : 'fail'
        ]);
    }
}

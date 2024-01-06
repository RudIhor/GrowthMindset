<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\Tag\TagCollection;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function __construct(private readonly TagService $tagService)
    {
    }

    /**
     * @return \App\Http\Resources\Tag\TagCollection
     */
    public function index(): TagCollection
    {
        return $this->tagService->getTags();
    }

    /**
     * @param \App\Models\Tag $tag
     * @return \App\Http\Resources\Tag\TagResource
     */
    public function show(Tag $tag): TagResource
    {
        return $this->tagService->getTag($tag);
    }

    /**
     * @param \App\Http\Requests\Tag\StoreTagRequest $request
     * @return \App\Models\Tag
     */
    public function store(StoreTagRequest $request): Tag
    {
        return $this->tagService->create($request);
    }

    /**
     * @param \App\Models\Tag $tag
     * @param \App\Http\Requests\Tag\UpdateTagRequest $request
     * @return \App\Models\Tag
     */
    public function update(Tag $tag, UpdateTagRequest $request): Tag
    {
        return $this->tagService->update($request, $tag);
    }

    /**
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
        return response()->json([
            'message' => $this->tagService->destroy($tag) ? 'success' : 'fail',
        ]);
    }
}

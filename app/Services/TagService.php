<?php

namespace App\Services;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\Tag\TagCollection;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;

class TagService
{
    /**
     * @return \App\Http\Resources\Tag\TagCollection
     */
    public function getTags(): TagCollection
    {
        return new TagCollection(Tag::paginate());
    }

    /**
     * @param \App\Models\Tag $tag
     * @return \App\Http\Resources\Tag\TagResource
     */
    public function getTag(Tag $tag): TagResource
    {
        return new TagResource($tag);
    }

    /**
     * @param \App\Http\Requests\Tag\StoreTagRequest $request
     * @return \App\Models\Tag
     */
    public function create(StoreTagRequest $request): Tag
    {
        return Tag::create($request->validated());
    }

    /**
     * @param \App\Http\Requests\Tag\UpdateTagRequest $request
     * @param \App\Models\Tag $tag
     * @return \App\Models\Tag
     */
    public function update(UpdateTagRequest $request, Tag $tag): Tag
    {
        $tag->update($request->validated());

        return $tag;
    }

    /**
     * @param \App\Models\Tag $tag
     * @return bool|null
     */
    public function destroy(Tag $tag): ?bool
    {
        return $tag->delete();
    }
}

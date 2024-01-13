<?php

namespace App\Http\Resources\Quote;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $content
 * @property \App\Models\Author $author
 * @property \App\Models\Category $category
 */
class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'author' => $this->author->full_name,
            'category' => $this->category->name,
        ];
    }
}

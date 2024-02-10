<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DecisiveStatement
 *
 * @property int $id
 * @property string $content
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecisiveStatement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DecisiveStatement extends Model
{
    use HasFactory;

    protected $fillable = [
       'content',
       'category_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

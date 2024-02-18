<?php

namespace Modules\Quote\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Author\app\Models\Author;
use Modules\Category\app\Models\Category;

/**
 * App\Models\Quote
 *
 * @property int $id
 * @property string $content
 * @property int|null $author_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Author\app\Models\Author|null $author
 * @property-read \Modules\Category\app\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'author_id',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

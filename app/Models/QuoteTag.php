<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * \App\Models\QuoteTag
 *
 * @property int $quote_id
 * @property int $tag_id
 * @method static \App\Models\QuoteTag create(array $value)
 */
class QuoteTag extends AbstractModel
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'quote_tag';

    protected $fillable = [
        'quote_id',
        'tag_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}

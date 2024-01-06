<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property bool|int $is_active
 * @property int $telegram_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription telegramUserId(int $id)
 * @method static \App\Models\Subscription create(array $data)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription find(int $id)
 */
class Subscription extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'telegram_user_id',
    ];

    protected $casts = [

    ];

    public function scopeTelegramUserId(Builder $query, int $id): void
    {
        $query->where('telegram_user_id', $id);
    }
}

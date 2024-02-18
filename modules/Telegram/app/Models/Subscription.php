<?php

namespace Modules\Telegram\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Telegram\app\Builders\SubscriptionBuilder;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property int $is_active
 * @property int $telegram_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static SubscriptionBuilder|Subscription newModelQuery()
 * @method static SubscriptionBuilder|Subscription newQuery()
 * @method static SubscriptionBuilder|Subscription query()
 * @method static SubscriptionBuilder|Subscription whereCreatedAt($value)
 * @method static SubscriptionBuilder|Subscription whereId($value)
 * @method static SubscriptionBuilder|Subscription whereIsActive($value)
 * @method static SubscriptionBuilder|Subscription whereTelegramUserId($value)
 * @method static SubscriptionBuilder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'telegram_user_id',
    ];

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return SubscriptionBuilder
     */
    public function newEloquentBuilder($query): SubscriptionBuilder
    {
        return new SubscriptionBuilder($query);
    }
}

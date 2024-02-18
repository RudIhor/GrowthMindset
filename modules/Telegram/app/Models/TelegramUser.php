<?php

namespace Modules\Telegram\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Modules\Telegram\app\Builders\TelegramUserBuilder;

/**
 * App\Models\TelegramUser
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property int $chat_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $language_code
 * @property-read \Modules\Telegram\app\Models\UserSetting $setting
 * @property-read \Modules\Telegram\app\Models\Subscription $subscription
 * @method static TelegramUserBuilder|TelegramUser newModelQuery()
 * @method static TelegramUserBuilder|TelegramUser newQuery()
 * @method static TelegramUserBuilder|TelegramUser query()
 * @method static TelegramUserBuilder|TelegramUser whereChatId($value)
 * @method static TelegramUserBuilder|TelegramUser whereCreatedAt($value)
 * @method static TelegramUserBuilder|TelegramUser whereFirstName($value)
 * @method static TelegramUserBuilder|TelegramUser whereId($value)
 * @method static TelegramUserBuilder|TelegramUser whereLanguageCode($value)
 * @method static TelegramUserBuilder|TelegramUser whereLastName($value)
 * @method static TelegramUserBuilder|TelegramUser whereUpdatedAt($value)
 * @method static TelegramUserBuilder|TelegramUser whereUsername($value)
 * @property-read \Modules\Telegram\app\Models\Rate|null $rate
 * @mixin \Eloquent
 */
class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'chat_id',
        'language_code',
    ];

    /**
     * @param Builder $query
     * @return TelegramUserBuilder
     */
    public function newEloquentBuilder($query): TelegramUserBuilder
    {
        return new TelegramUserBuilder($query);
    }

    /**
     * @return HasOne
     */
    public function setting(): HasOne
    {
        return $this->hasOne(TelegramUserSetting::class);
    }

    /**
     * @return HasOne
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * @return HasOne
     */
    public function rate(): HasOne
    {
        return $this->hasOne(Rate::class);
    }
}

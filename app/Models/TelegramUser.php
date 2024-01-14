<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\TelegramUser
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string $chat_id
 * @property string $language_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\UserSetting $setting
 * @property \App\Models\Subscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|void chatId(string|int $chatId)
 * @method static \App\Models\TelegramUser create(array $data)
 */
class TelegramUser extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'chat_id',
        'language_code',
    ];

    public function scopeChatId(Builder $query, int|string $chatId): void
    {
        $query->where('chat_id', $chatId);
    }

    public function setting(): HasOne
    {
        return $this->hasOne(UserSetting::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }
}

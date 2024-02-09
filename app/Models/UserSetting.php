<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSetting
 *
 * @property int $id
 * @property int $notifications_per_day
 * @property int $telegram_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereNotificationsPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereTelegramUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'notifications_per_day',
        'telegram_user_id',
    ];
}

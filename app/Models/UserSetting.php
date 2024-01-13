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
 * @method static \App\Models\UserSetting create(array $data)
 */
class UserSetting extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'notifications_per_day',
        'telegram_user_id',
    ];
}

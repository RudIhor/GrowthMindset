<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * \App\Models\TelegramUserJob
 *
 * @property int $id
 * @property int $telegram_user_id
 * @property int $job_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class TelegramUserJob extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'telegram_user_id',
        'job_id',
    ];
}

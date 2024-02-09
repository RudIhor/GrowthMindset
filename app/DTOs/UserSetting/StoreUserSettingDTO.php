<?php

namespace App\DTOs\UserSetting;

use Spatie\LaravelData\Data;

class StoreUserSettingDTO extends Data
{
    public function __construct(public int $telegramUserId, public int|string $notificationsPerDay) {}
}

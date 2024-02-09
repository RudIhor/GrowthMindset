<?php

namespace App\Actions\UserSetting;

use App\DTOs\UserSetting\StoreUserSettingDTO;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateUserSettingAction
{
    /**
     * @param StoreUserSettingDTO $userSettingDTO
     * @return Model|Builder|UserSetting
     */
    public function execute(StoreUserSettingDTO $userSettingDTO): Model|Builder|UserSetting
    {
        return UserSetting::query()->create([
            'telegram_user_id' => $userSettingDTO->telegramUserId,
            'notifications_per_day' => $userSettingDTO->notificationsPerDay,
        ]);
    }
}

<?php

namespace Modules\Telegram\app\Actions\TelegramUserSetting;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Telegram\app\DTOs\UserSetting\StoreUserSettingDTO;
use Modules\Telegram\app\Models\TelegramUserSetting;

class CreateUserSettingAction
{
    /**
     * @param StoreUserSettingDTO $userSettingDTO
     * @return Model|Builder|UserSetting
     */
    public function execute(StoreUserSettingDTO $userSettingDTO): Model|Builder|TelegramUserSetting
    {
        return TelegramUserSetting::query()->create([
            'telegram_user_id' => $userSettingDTO->telegramUserId,
            'notifications_per_day' => $userSettingDTO->notificationsPerDay,
        ]);
    }
}

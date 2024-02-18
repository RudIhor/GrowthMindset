<?php

namespace Modules\Telegram\app\Actions\TelegramUser;

use Modules\Telegram\app\DTOs\TelegramUser\UpdateTelegramUserLanguageDTO;
use Modules\Telegram\app\Models\TelegramUser;

class UpdateTelegramUserLanguageAction
{
    /**
     * @param UpdateTelegramUserLanguageDTO $telegramUserLanguageDTO
     * @return bool
     */
    public function execute(UpdateTelegramUserLanguageDTO $telegramUserLanguageDTO): bool
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::whereChatId($telegramUserLanguageDTO->chatId)->first();
        return $telegramUser->update([
            'language_code' => $telegramUserLanguageDTO->languageCode,
        ]);
    }
}

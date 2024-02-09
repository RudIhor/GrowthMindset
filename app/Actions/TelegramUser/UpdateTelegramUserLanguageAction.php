<?php

namespace App\Actions\TelegramUser;

use App\DTOs\TelegramUser\UpdateTelegramUserLanguageDTO;
use App\Models\TelegramUser;

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

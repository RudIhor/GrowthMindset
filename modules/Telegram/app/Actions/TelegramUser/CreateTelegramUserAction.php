<?php

namespace Modules\Telegram\app\Actions\TelegramUser;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Telegram\app\DTOs\TelegramUser\StoreTelegramUserDTO;
use Modules\Telegram\app\Models\TelegramUser;

class CreateTelegramUserAction
{
    /**
     * @param StoreTelegramUserDTO $telegramUserDTO
     * @return Builder|TelegramUser|Model
     */
    public function execute(StoreTelegramUserDTO $telegramUserDTO): Builder|TelegramUser|Model
    {
        return TelegramUser::query()->create([
            'chat_id' => $telegramUserDTO->message?->chat()?->id(),
            'first_name' => $telegramUserDTO->message?->from()?->firstName(),
            'last_name' => $telegramUserDTO->message?->from()?->lastName(),
            'username' => $telegramUserDTO->message?->from()?->username(),
            'language_code' => $telegramUserDTO->languageCode,
        ]);
    }
}

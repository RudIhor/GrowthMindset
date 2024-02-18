<?php

namespace Modules\Telegram\app\DTOs\TelegramUser;

use Spatie\LaravelData\Data;

class UpdateTelegramUserLanguageDTO extends Data
{
    public function __construct(public string $chatId, public string $languageCode) {}
}

<?php

namespace App\DTOs\TelegramUser;

use DefStudio\Telegraph\DTO\Message;
use Spatie\LaravelData\Data;

class StoreTelegramUserDTO extends Data
{
    public function __construct(public ?Message $message, public ?string $languageCode) {}
}

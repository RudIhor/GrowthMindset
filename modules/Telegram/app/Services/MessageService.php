<?php

namespace Modules\Telegram\app\Services;

use Modules\Telegram\app\Enums\LanguageCode;

class MessageService
{
    public function __construct(private readonly string $languageCode) {}

    /**
     * @return string
     */
    public function handleUnknownCommand(): string
    {
        return __('bot.handle_unknown_command', locale: $this->languageCode);
    }

    /**
     * @return string
     */
    public function help(): string
    {
        return __('bot.help', locale: $this->languageCode);
    }

    /**
     * @return string
     */
    public function start(): string
    {
        return __('bot.welcome', locale: $this->languageCode);
    }

    /**
     * @return string
     */
    public function unSubscribe(): string
    {
        return __('bot.unsubscribed', locale: $this->languageCode);
    }

    /**
     * @param int $notificationsAmount
     * @return string
     */
    public function mySettings(int $notificationsAmount): string
    {
        return sprintf(
            __('bot.my_settings', locale: $this->languageCode),
            $notificationsAmount,
            LanguageCode::from($this->languageCode)->emoji()
        );
    }

    /**
     * @return string
     */
    public function setNotificationsAmount(): string
    {
        return __('bot.start_receive', locale: $this->languageCode);
    }

    /**
     * @return string
     */
    public function setLanguageCode(): string
    {
        return __('bot.language_updated', locale: $this->languageCode);
    }

    /**
     * @return string
     */
    public function setRating(): string
    {
        return __('bot.set_rating', locale: $this->languageCode);
    }
}

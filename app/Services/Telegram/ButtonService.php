<?php

namespace App\Services\Telegram;

use App\Enums\LanguageCode;
use DefStudio\Telegraph\Keyboard\Button;

class ButtonService
{
    /**
     * @return array|Button[]
     */
    public function languageButtons(): array
    {
        return array_map(function ($value) {
            return Button::make(LanguageCode::from($value)->emoji())->action('setLanguageCode')->param(
                'language_code',
                $value
            );
        }, config('quotes.available_languages'));
    }

    /**
     * @return array|Button[]
     */
    public function availableOptions(): array
    {
        return array_map(function ($value) {
            return Button::make($value)->action('setNotificationsAmount')->param('number', $value);
        }, config('quotes.available_options'));
    }
}

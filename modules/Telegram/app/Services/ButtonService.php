<?php

namespace Modules\Telegram\app\Services;

use DefStudio\Telegraph\Keyboard\Button;
use Modules\Telegram\app\Enums\LanguageCode;

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

    /**
     * @return array|Button[]
     */
    public function rateButtons(): array
    {
        return array_map(function ($value) {
            return Button::make($value)->action('setRating')->param('value', $value);
        }, config('quotes.rates'));
    }
}

<?php

namespace App\Constants;

use App\Enums\LanguageCode;

class Flag
{
    /**
     * @param string $languageCode
     * @return string
     */
    public static function getEmoji(string $languageCode): string
    {
        $lookup = [
            LanguageCode::EN->value => '🇺🇸',
            LanguageCode::UK->value => '🇺🇦',
            LanguageCode::ES->value => '🇪🇸',
            LanguageCode::DE->value => '🇩🇪',
        ];

        return $lookup[$languageCode];
    }
}

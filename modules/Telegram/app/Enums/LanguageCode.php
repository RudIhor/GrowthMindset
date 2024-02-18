<?php

namespace Modules\Telegram\app\Enums;

enum LanguageCode: string
{
    case EN = 'en';
    case UK = 'uk';
    case ES = 'es';
    case DE = 'de';

    public static function isTranslationable(string $languageCode): bool
    {
        return in_array($languageCode, [
            self::DE->value,
            self::ES->value,
            self::UK->value,
        ]);
    }

    public function emoji(): string
    {
        return match($this) {
            self::EN => '🇺🇸',
            self::UK => '🇺🇦',
            self::ES => '🇪🇸',
            self::DE => '🇩🇪',
        };
    }
}

<?php

use App\Enums\LanguageCode;

return [
    'available_options' => [1, 2, 3, 4, 5, 7, 9, 10],
    'available_languages' => [
        LanguageCode::EN->value,
        LanguageCode::ES->value,
        LanguageCode::UK->value,
        LanguageCode::DE->value,
    ],
];

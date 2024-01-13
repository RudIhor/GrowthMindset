<?php

use App\Enums\Time;

return [
    'notifications' => [
        1 => [
            'step' => Time::Hour->value * 24,
        ],
        2 => [
            'step' => Time::Hour->value * 12,
        ],
        3 => [
            'step' => Time::Hour->value * 8,
        ],
        4 => [
            'step' => Time::Hour->value * 6,
        ],
        5 => [
            'step' => Time::Hour->value * 2.8,
        ],
        7 => [
            'step' => Time::Hour->value * 2,
        ],
        9 => [
            'step' => Time::Hour->value + 2000,
        ],
        10 => [
            'step' => Time::Hour->value + 1440,
        ],
    ],
    'from' => [
        'hours' => 6,
        'seconds' => 30,
    ],
    'to' => [
        'hours' => 19,
    ],
];

<?php

use App\Enums\Time;

return [
    'notifications' => [
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
        12 => [
            'step' => Time::Hour->value + 600,
        ],
        14 => [
            'step' => Time::Hour->value,
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

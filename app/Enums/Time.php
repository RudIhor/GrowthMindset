<?php

namespace App\Enums;

enum Time: int
{
    case Minute = 60;
    case Hour = 3600;
    case Day = 86400;
}

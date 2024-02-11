<?php

namespace App\DTOs\Rate;

use Spatie\LaravelData\Data;

class StoreRateDTO extends Data
{
    public function __construct(public string|int $chatId, public int $rating) {}
}

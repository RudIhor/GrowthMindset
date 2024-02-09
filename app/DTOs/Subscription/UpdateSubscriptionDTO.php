<?php

namespace App\DTOs\Subscription;

use Spatie\LaravelData\Data;

class UpdateSubscriptionDTO extends Data
{
    public function __construct(public string $chatId, public int $isActive) {}
}

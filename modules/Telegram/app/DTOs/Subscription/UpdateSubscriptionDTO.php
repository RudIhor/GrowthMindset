<?php

namespace Modules\Telegram\app\DTOs\Subscription;

use Spatie\LaravelData\Data;

class UpdateSubscriptionDTO extends Data
{
    public function __construct(public string $chatId, public int $isActive) {}
}

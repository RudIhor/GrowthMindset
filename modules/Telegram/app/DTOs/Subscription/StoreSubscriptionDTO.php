<?php

namespace Modules\Telegram\app\DTOs\Subscription;

use Spatie\LaravelData\Data;

class StoreSubscriptionDTO extends Data
{
    public function __construct(public int $telegramUserId, public int $isActive) {}
}

<?php

namespace Modules\Telegram\app\Actions\Subscription;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Telegram\app\DTOs\Subscription\StoreSubscriptionDTO;
use Modules\Telegram\app\Models\Subscription;

class CreateSubscriptionAction
{
    /**
     * @param StoreSubscriptionDTO $subscriptionDTO
     * @return Model|Builder|Subscription
     */
    public function execute(StoreSubscriptionDTO $subscriptionDTO): Model|Builder|Subscription
    {
        return Subscription::query()->create([
            'telegram_user_id' => $subscriptionDTO->telegramUserId,
            'is_active' => $subscriptionDTO->isActive,
        ]);
    }
}

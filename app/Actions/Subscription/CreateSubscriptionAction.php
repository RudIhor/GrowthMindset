<?php

namespace App\Actions\Subscription;

use App\DTOs\Subscription\StoreSubscriptionDTO;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

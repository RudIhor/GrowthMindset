<?php

namespace App\Actions\Subscription;

use App\DTOs\Subscription\UpdateSubscriptionDTO;
use App\Enums\SubscriptionType;
use App\Models\TelegramUser;

class UpdateSubscriptionAction
{
    /**
     * @param UpdateSubscriptionDTO $subscriptionDTO
     * @return bool
     */
    public function execute(UpdateSubscriptionDTO $subscriptionDTO): bool
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::whereChatId($subscriptionDTO->chatId)->first();
        return (bool) $telegramUser->subscription()->update([
            'is_active' => SubscriptionType::from($subscriptionDTO->isActive)->value,
        ]);
    }
}

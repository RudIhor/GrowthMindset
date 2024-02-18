<?php

namespace Modules\Telegram\app\Actions\Subscription;

use Modules\Telegram\app\DTOs\Subscription\UpdateSubscriptionDTO;
use Modules\Telegram\app\Enums\SubscriptionType;
use Modules\Telegram\app\Models\TelegramUser;

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

<?php

namespace Modules\Telegram\app\Builders;

use Illuminate\Database\Eloquent\Builder;

class SubscriptionBuilder extends Builder
{
    /**
     * @param int $id
     * @return SubscriptionBuilder
     */
    public function whereTelegramUserId(int $id): SubscriptionBuilder
    {
        return $this->where('telegram_user_id', $id);
    }
}

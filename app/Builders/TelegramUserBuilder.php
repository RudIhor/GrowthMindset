<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class TelegramUserBuilder extends Builder
{
    /**
     * @param int|string $chatId
     * @return TelegramUserBuilder
     */
    public function whereChatId(int|string $chatId): TelegramUserBuilder
    {
        return $this->where('chat_id', $chatId);
    }
}

<?php

namespace Modules\Telegram\app\Actions\Rate;

use Illuminate\Database\Eloquent\Model;
use Modules\Telegram\app\DTOs\Rate\StoreRateDTO;
use Modules\Telegram\app\Models\Rate;
use Modules\Telegram\app\Models\TelegramUser;

class CreateRateAction
{
    /**
     * Creates a rate.
     *
     * @param StoreRateDTO $storeRateDTO
     * @return Model
     */
    public function execute(StoreRateDTO $storeRateDTO): Model
    {
        $telegramUser = TelegramUser::whereChatId($storeRateDTO->chatId)->first();

        return Rate::query()->create(['telegram_user_id' => $telegramUser->id, 'rate' => $storeRateDTO->rating]);
    }
}

<?php

namespace App\Actions\Rate;

use App\DTOs\Rate\StoreRateDTO;
use App\Models\Rate;
use App\Models\TelegramUser;
use Illuminate\Database\Eloquent\Model;

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

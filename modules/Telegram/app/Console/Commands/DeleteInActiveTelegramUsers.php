<?php

namespace Modules\Telegram\app\Console\Commands;

use Illuminate\Console\Command;
use Modules\Telegram\app\Models\Subscription;
use Modules\Telegram\app\Models\TelegramUser;
use Modules\Telegram\app\Models\TelegramUserSetting;

class DeleteInActiveTelegramUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-in-active-telegram-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete in-active users from telegram_users table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $activeUsersIds = Subscription::query()->where('is_active', 1)->pluck('id');
        TelegramUserSetting::query()->whereNotIn('telegram_user_id', $activeUsersIds)->delete();
        Subscription::query()->whereNotIn('telegram_user_id', $activeUsersIds)->delete();
        TelegramUser::query()->whereNotIn('id', $activeUsersIds)->delete();
    }
}

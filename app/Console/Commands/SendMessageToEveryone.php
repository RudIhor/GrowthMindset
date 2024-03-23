<?php

namespace App\Console\Commands;

use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Console\Command;
use Modules\Telegram\app\Models\TelegramUser;

use const _PHPStan_11268e5ee\__;

class SendMessageToEveryone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-message-to-everyone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send message to everyone who uses our bot.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $telegramUsers = TelegramUser::all();
        foreach ($telegramUsers as $telegramUser) {
            Telegraph::chat($telegramUser->chat_id)->message(__('bot.new-release', locale: $telegramUser->language_code))->send();
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\TelegramUser;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Console\Command;

class SendMessageToEveryone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:send-message-to-everyone';

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
            $text = __('bot.rate_our_work', locale: $telegramUser->language_code);
            Telegraph::chat($telegramUser->chat_id)->message($text)->send();
        }
    }
}

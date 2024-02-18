<?php

namespace Modules\Telegram\app\Console\Commands;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;

class RegisterBotCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register-bot-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simply register given commands to your bot in telegram.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /** @var TelegraphBot $bot */
        $bot = TelegraphBot::query()->findOrFail(1);

        $bot->registerCommands([
            'start' => 'Start your journey',
            'help' => 'Get list of available commands',
            'settings' => 'Set up new settings',
            'mysettings' => 'See my current settings',
            'subscribe' => 'Start receive your quotes',
            'unsubscribe' => 'Cancel your active subscription',
            'randomquote' => 'Get a random quote',
        ])->send();
    }
}

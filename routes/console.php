<?php

use App\Models\Quote;
use DefStudio\Telegraph\Models\TelegraphBot;
use GuzzleHttp\Client;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('register-commands', function () {
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
    $bot = TelegraphBot::find(1);

    $bot->registerCommands([
        'help' => 'Get list of available commands',
        'settings' => 'Set up your profile settings',
        'subscribe' => 'Subscribe to get awesome quotes',
        'unsubscribe' => 'Unsubscribe of getting quotes'
    ])->send();
});

Artisan::command('test', function (\App\Services\QuoteService $service) {
    throw new Exception('Quote wasnot found');
});

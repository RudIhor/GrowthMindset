<?php

namespace Modules\Telegram\app\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Modules\Telegram\app\Console\Commands\RegisterBotCommands;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function boot(): void
    {
        $this->commands(RegisterBotCommands::class);
    }
}

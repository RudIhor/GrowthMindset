<?php

namespace Modules\Telegram\app\Providers;

use App\Providers\AppServiceProvider;

class TelegramServiceProvider extends AppServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config.php', 'telegram');

        $this->app->register(RouteServiceProvider::class);
    }
}

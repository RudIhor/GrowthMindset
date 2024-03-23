<?php

namespace Modules\Category\app\Providers;

use App\Providers\AppServiceProvider;

class CategoryServiceProvider extends AppServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config.php', 'category');

        $this->app->register(RouteServiceProvider::class);
    }
}

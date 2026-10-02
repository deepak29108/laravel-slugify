<?php

namespace Deepphp\Slugify\Providers;

use Deepphp\Slugify\Service\SlugifyService;
use Illuminate\Support\ServiceProvider;

class SlugifyProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('slugify', SlugifyService::class);
    }

    public function boot(): void
    {
    }
}
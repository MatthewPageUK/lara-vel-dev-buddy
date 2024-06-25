<?php

namespace MatthewPageUK\LaraVelDevBuddy;

use Illuminate\Support\ServiceProvider;

class LaraVelDevBuddyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lara-vel-dev-buddy.php', 'lara-vel-dev-buddy');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lvdb');
    }
}

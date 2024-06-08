<?php

namespace MatthewPageUK\LaraVelDevBuddy;

use Illuminate\Support\ServiceProvider;

class LaraVelDevBuddyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lara-vel-dev-buddy.php', 'lara-vel-dev-buddy');

        // $this->app->bind(Contracts\BittyContainer::class, Support\Container::class);
        // $this->app->bind(Contracts\BittyValidator::class, Support\Validator::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                //
            ]);
        }


        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lara-vel-dev-buddy');
    }
}

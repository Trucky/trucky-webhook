<?php

namespace Trucky\Webhook;

use Illuminate\Support\ServiceProvider;

class TruckyWebhookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishables();

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
    }

    protected function registerPublishables(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/trucky-webhook.php' => config_path('trucky-webhook.php'),
        ], 'config');
    }
}
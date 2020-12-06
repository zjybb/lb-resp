<?php

namespace Zjybb\Response;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->singleton('resp', ApiResponse::class);
    }

    public function boot(){
        $this->loadTranslationsFrom(__DIR__ . '/../translations', 'lb-resp');
    }
}

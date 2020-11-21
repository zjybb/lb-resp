<?php

namespace Zjybb\Response;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->singleton('resp', function () {
            return new ApiResponse();
        });
    }

    public function boot(){
        $this->loadTranslationsFrom(__DIR__ . '/../translations', 'lb-resp');
    }
}

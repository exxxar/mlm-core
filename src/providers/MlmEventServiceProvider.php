<?php

namespace Mlm\MlmCore\Providers;

use Cryptolib\CryptoCore\events\HandleMSEvent;
use Cryptolib\CryptoCore\listeners\HandleMLMListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class MlmEventServiceProvider extends ServiceProvider
{

    protected $listen = [
      /*  HandleMSEvent::class => [
            HandleMSListener::class,
        ]*/
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

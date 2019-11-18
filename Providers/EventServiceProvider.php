<?php

namespace Pingu\Devel\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Pingu\Devel\Listeners\AddFormToCollector;
use Pingu\Forms\Events\FormBuilt;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FormBuilt::class => [
            AddFormToCollector::class
        ]
    ];
}
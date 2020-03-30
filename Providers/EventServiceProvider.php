<?php

namespace Pingu\Devel\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Pingu\Core\Events\Rendered;
use Pingu\Devel\Listeners\AddFormToCollector;
use Pingu\Devel\Listeners\AddViewNamesHelper;
use Pingu\Forms\Events\FormBuilt;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FormBuilt::class => [
            AddFormToCollector::class
        ],
        Rendered::class => [
            AddViewNamesHelper::class
        ]
    ];
}
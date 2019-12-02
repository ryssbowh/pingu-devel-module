<?php

namespace Pingu\Devel\Facades;

use Illuminate\Support\Facades\Facade;

class Cron extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'devel.cron';
    }
}
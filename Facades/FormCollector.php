<?php

namespace Pingu\Devel\Facades;

use Illuminate\Support\Facades\Facade;

class FormCollector extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'devel.formCollector';
    }
}
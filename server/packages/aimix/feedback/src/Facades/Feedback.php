<?php

namespace Aimix\Feedback\Facades;

use Illuminate\Support\Facades\Facade;

class Feedback extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'feedback';
    }
}

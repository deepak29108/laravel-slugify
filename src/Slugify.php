<?php

namespace Deepphp\Slugify;

use Illuminate\Support\Facades\Facade;

class Slugify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'slugify';
    }
}
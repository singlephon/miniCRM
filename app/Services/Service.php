<?php

namespace App\Services;

abstract class Service
{

    final public static function make(): Service|static
    {
        return app(static::class);
    }
}

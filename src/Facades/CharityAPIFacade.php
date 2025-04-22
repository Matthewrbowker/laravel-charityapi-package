<?php

namespace laravelCharityAPI\CharityAPI\Facades;

use Illuminate\Support\Facades\Facade;
use laravelCharityAPI\CharityAPI\CharityAPI;

class CharityAPIFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CharityAPI::class;
    }
}
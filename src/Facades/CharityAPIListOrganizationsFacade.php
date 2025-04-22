<?php

namespace laravelCharityAPI\CharityAPI\Facades;

use Illuminate\Support\Facades\Facade;
use laravelCharityAPI\CharityAPI\Requests\CharityAPIListOrganizationsRequest;

class CharityAPIListOrganizationsFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CharityAPIListOrganizationsRequest::class;
    }
}
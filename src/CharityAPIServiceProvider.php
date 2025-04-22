<?php

namespace laravelCharityAPI\CharityAPI;

use Illuminate\Support\ServiceProvider;
use laravelCharityAPI\CharityAPI\Requests\CharityAPIListOrganizationsRequest;

class CharityAPIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('CharityAPIListOrganizations', function ($app) {
            return new CharityAPIListOrganizationsRequest();
        });

        $this->app->bind("charityAPI", function ($app) {
            return new CharityAPI();
        });
    }
}
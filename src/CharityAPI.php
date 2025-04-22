<?php

namespace laravelCharityAPI\CharityAPI;

use laravelCharityAPI\CharityAPI\Requests\CharityAPIGetOrganizationRequest;
use laravelCharityAPI\CharityAPI\Requests\CharityAPIListOrganizationsRequest;

class CharityAPI
{
    public function listOrganizations(): CharityAPIListOrganizationsRequest
    {
        return new CharityAPIListOrganizationsRequest();
    }

    public function getOrganization(): CharityAPIGetOrganizationRequest
    {
        return new CharityAPIGetOrganizationRequest();
    }

}
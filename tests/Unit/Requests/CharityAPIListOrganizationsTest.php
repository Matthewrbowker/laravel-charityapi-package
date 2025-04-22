<?php

use laravelCharityAPI\CharityAPI\Requests\CharityAPIListOrganizationsRequest;

test('can initialize', function () {
    try{
        $request = new CharityAPIListOrganizationsRequest();
    }
    catch(Exception $e) {
        $this->fail();
    }

    expect($request)->toBeInstanceOf(CharityAPIListOrganizationsRequest::class);
});

test('Request can be executed', function () {
    try {
        $expectedResponse = loadJsonFile('CharityAPIListOrganizationsResponseSuccess.json');
    }
    catch(Exception $e) {
        $this->fail($e->getMessage());
    }


});
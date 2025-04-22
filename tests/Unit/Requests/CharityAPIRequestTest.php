<?php

use laravelCharityAPI\CharityAPI\CharityAPIException;
use laravelCharityAPI\CharityAPI\Requests\CharityAPIRequest;


/*
 * Testing that we can initialize the abstract class as a static class - as needed for these other tests.
 */
test('Initializes', function() {
    expect("\\laravelCharityAPI\CharityAPI\\CharityAPIRequest")->toBeAbstract();

    $request = createAbstractCharityAPIRequest();

    expect($request)->toBeInstanceOf(CharityAPIRequest::class);
});

/*
 * Expect the abstract class to throw an exception if there is no API key - since it's not worth any further requests
 */
test('Throws an exception with no API key set', function() {
    $request = createAbstractCharityAPIRequest();

    // API key shouldn't be set, so we expect an exception
    expect(fn() => $request->send())->toThrow(CharityAPIException::class);
});

/*
 * If the API key is not provided in the environment but is passed in,
 */
test('Sets API key and sends request', function() {
    $request = createAbstractCharityAPIRequest();

    // Set API Key and test that we don't get an exception.
    expect($request->setApiKey("api-TESTING"))->toBeInstanceOf(CharityAPIRequest::class)
    ->and(fn() => $request->send())->not->toThrow(CharityAPIException::class);

});
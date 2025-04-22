<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use laravelCharityAPI\CharityAPI\Requests\CharityAPIRequest;

pest()->extend(Tests\TestCase::class)->in('Feature');
pest()->extend(Tests\TestCase::class)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}

function createAbstractCharityAPIRequest() {
    return new class extends CharityAPIRequest {
        public function send(): stdClass
        {
            $response = $this->sendInternal();

            return $this->convertToResponseObject($response);
        }

        protected function convertToResponseObject(\Psr\Http\Message\ResponseInterface $response): stdClass
        {
            return new \stdClass();
        }
    };
}

/**
 * @throws Exception
 */
function loadJsonFile($filename) {
    $fileLocation = __DIR__ . "/Resources/{$filename}";

    if(!file_exists($fileLocation)) {
        throw new \Exception("File {$filename} does not exist");
    }

    return json_decode(file_get_contents($fileLocation));
}
<?php

namespace laravelCharityAPI\CharityAPI\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use laravelCharityAPI\CharityAPI\CharityAPIException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

abstract class CharityAPIRequest
{
    private string $api_key;

    protected string $uri;

    private array $arguments = [];

    /**
     *
     */
    public function __construct()
    {
        // We are using an empty string default here - users will have the option to set their API key using a call on
        // the setAPIKey() method so we need a workable string in the meantime.
        //  We will throw an exception if the key isn't set in sendInternal()
        $this->api_key = config('charityapi.api_key', "");
    }


    /**
     * Gets the currently configured URL
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }


    /**
     * Gets the currently configured API key.
     *
     * @return string
     */
    public function getAPIKey(): string
    {
        return $this->api_key;
    }


    /**
     * Allows you to set the API key.
     *
     * @param string $api_key API Key to save
     * @return $this
     */
    public function setAPIKey(string $api_key): self
    {
        $this->api_key = $api_key;

        return $this;
    }


    /**
     * Adds a parameter to the URI when we send the request.
     *
     * @param string $key Parameter key
     * @param string $value Parameter value
     * @return void
     */
    protected function addArgument(string $key, string $value): void
    {
        $this->arguments[$key] = $value;
    }

    /**
     * This method handles the actual Guzzle request.
     * It's only meant to be used internally.
     *
     * @throws CharityAPIException
     */
    protected function sendInternal(): ResponseInterface
    {
        if($this->api_key == "") {
            throw new CharityAPIException("Charity API Key not set");
        }

        $client = new Client();

        $request = new Request("GET", "https://api.charityapi.org/api/" . $this->uri);

        $request->withHeader('apikey', $this->api_key);

        foreach($this->arguments as $key => $value) {
            $request = $request->withQueryValue($key, $value);
        }

        try {
            $response = $client->sendRequest($request);
        }
        catch(GuzzleException|ClientExceptionInterface $e) {
            throw new CharityAPIException($e->getMessage());
        }

        return $response;
    }

    /**
     * Sends the request.
     *
     * This abstract method is meant to be implemented in all child classes.
     */
    public abstract function send();

    protected abstract function convertToResponseObject(ResponseInterface $response);
}
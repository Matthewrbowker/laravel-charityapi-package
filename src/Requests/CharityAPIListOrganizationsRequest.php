<?php

namespace laravelCharityAPI\CharityAPI\Requests;

use Illuminate\Support\Facades\Date;
use laravelCharityAPI\CharityAPI\CharityAPIException;
use Psr\Http\Message\ResponseInterface;

class CharityAPIListOrganizationsRequest extends CharityAPIRequest
{
    public function __construct() {
        parent::__construct();
        $this->uri = 'organizations';
    }

    /**
     * @throws CharityAPIException
     */
    public function since(string|Date $date) {
        if(empty($date)) {
            throw new CharityAPIException("Date cannot be empty");
        }

        if(is_string($date)) {
            $date = Date::parse($date);

            if(!$date) {
                throw new CharityAPIException("Invalid date format");
            }
        }

        $this->addArgument('since', $date->format('Y-m-d'));

        return $this;
    }

    public function send() {
        // TODO: This.
    }

    protected function convertToResponseObject(ResponseInterface $response)
    {
        // TODO: Implement convertToResponseObject() method.
    }
}
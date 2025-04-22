<?php

namespace laravelCharityAPI\CharityAPI\Requests;

use laravelCharityAPI\CharityAPI\CharityAPIException;
use laravelCharityAPI\CharityAPI\Responses\CharityAPIGetOrganizationResponse;
use Psr\Http\Message\ResponseInterface;

class CharityAPIGetOrganizationRequest extends CharityAPIRequest
{
    private $hasSetEIN = false;

    /**
     * @throws CharityAPIException
     */
    public function setEIN($ein)
    {
        if( !is_numeric($ein)) {
            throw new CharityAPIException("EIN must be numeric");
        }

        $this->uri = "organizations/{$ein}";

        $this->hasSetEIN = true;

        return $this;
    }

    public function send()
    {
        if(!$this->hasSetEIN) {
            throw new CharityAPIException("EIN must be set");
        }

        $response = $this->sendInternal();

        return $this->convertToResponseObject($response);
    }

    protected function convertToResponseObject(ResponseInterface $response): CharityAPIGetOrganizationResponse
    {
        $responseData = json_decode($response->getBody());

        $convertedObject = new CharityAPIGetOrganizationResponse();

        $convertedObject->setDidSucceed($responseData->didSucceed);

        return $convertedObject;
    }
}
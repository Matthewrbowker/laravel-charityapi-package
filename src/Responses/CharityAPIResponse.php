<?php

namespace laravelCharityAPI\CharityAPI\Responses;

abstract class CharityAPIResponse
{
    protected bool $didSucceed = false;

    public function getDidSucceed(): bool
    {
        return $this->didSucceed;
    }

    public function setDidSucceed($didSucceed): self
    {
        $this->didSucceed = $didSucceed;

        return $this;
    }


}
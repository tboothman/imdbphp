<?php

namespace GraphQL\SchemaObject;

class PostalCodeLocationInputObject extends InputObject
{
    protected $country;
    protected $postalCode;

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class OriginCountrySearchConstraintInputObject extends InputObject
{
    protected $anyCountries;
    protected $anyPrimaryCountries;

    public function setAnyCountries(array $anyCountries)
    {
        $this->anyCountries = $anyCountries;

        return $this;
    }

    public function setAnyPrimaryCountries(array $anyPrimaryCountries)
    {
        $this->anyPrimaryCountries = $anyPrimaryCountries;

        return $this;
    }
}

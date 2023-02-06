<?php

namespace GraphQL\SchemaObject;

class WatchOptionsLocationInputObject extends InputObject
{
    protected $latLong;
    protected $postalCodeLocation;

    public function setLatLong(LatLongInputObject $latLongInputObject)
    {
        $this->latLong = $latLongInputObject;

        return $this;
    }

    public function setPostalCodeLocation(PostalCodeLocationInputObject $postalCodeLocationInputObject)
    {
        $this->postalCodeLocation = $postalCodeLocationInputObject;

        return $this;
    }
}

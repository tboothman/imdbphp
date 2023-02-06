<?php

namespace GraphQL\SchemaObject;

class ShowtimesLocationInputObject extends InputObject
{
    protected $latLong;
    protected $postalCode;
    protected $radiusInMeters;

    public function setLatLong(LatLongInputObject $latLongInputObject)
    {
        $this->latLong = $latLongInputObject;

        return $this;
    }

    public function setPostalCode(ShowtimesPostalCodeLocationInputObject $showtimesPostalCodeLocationInputObject)
    {
        $this->postalCode = $showtimesPostalCodeLocationInputObject;

        return $this;
    }

    public function setRadiusInMeters($radiusInMeters)
    {
        $this->radiusInMeters = $radiusInMeters;

        return $this;
    }
}

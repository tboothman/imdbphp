<?php

namespace GraphQL\SchemaObject;

class LatLongInputObject extends InputObject
{
    protected $lat;
    protected $long;

    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }
}

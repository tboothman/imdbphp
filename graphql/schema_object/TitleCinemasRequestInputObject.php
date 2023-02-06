<?php

namespace GraphQL\SchemaObject;

class TitleCinemasRequestInputObject extends InputObject
{
    protected $location;

    public function setLocation(ShowtimesLocationInputObject $showtimesLocationInputObject)
    {
        $this->location = $showtimesLocationInputObject;

        return $this;
    }
}

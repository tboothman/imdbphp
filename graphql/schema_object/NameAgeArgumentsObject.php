<?php

namespace GraphQL\SchemaObject;

class NameAgeArgumentsObject extends ArgumentsObject
{
    protected $currentDate;

    public function setCurrentDate($currentDate)
    {
        $this->currentDate = $currentDate;

        return $this;
    }
}

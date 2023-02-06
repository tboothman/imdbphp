<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class NameHeightArgumentsObject extends ArgumentsObject
{
    protected $unit;

    public function setUnit($lengthUnit)
    {
        $this->unit = new RawObject($lengthUnit);

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class GetNameWeightInputInputObject extends InputObject
{
    protected $unit;

    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }
}

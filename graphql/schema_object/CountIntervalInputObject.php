<?php

namespace GraphQL\SchemaObject;

class CountIntervalInputObject extends InputObject
{
    protected $max;
    protected $min;

    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }
}

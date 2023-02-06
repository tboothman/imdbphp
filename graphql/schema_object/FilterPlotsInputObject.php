<?php

namespace GraphQL\SchemaObject;

class FilterPlotsInputObject extends InputObject
{
    protected $spoilers;
    protected $type;

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }

    public function setType(array $type)
    {
        $this->type = $type;

        return $this;
    }
}

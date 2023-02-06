<?php

namespace GraphQL\SchemaObject;

class RootTrackedNamesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

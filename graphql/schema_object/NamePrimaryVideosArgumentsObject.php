<?php

namespace GraphQL\SchemaObject;

class NamePrimaryVideosArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
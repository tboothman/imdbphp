<?php

namespace GraphQL\SchemaObject;

class PublicityCategoryWithListingsPublicityListingsArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataPersonalLocationsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

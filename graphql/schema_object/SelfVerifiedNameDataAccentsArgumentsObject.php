<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataAccentsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

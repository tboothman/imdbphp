<?php

namespace GraphQL\SchemaObject;

class CompanyCreditAttributesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

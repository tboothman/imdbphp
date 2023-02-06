<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataWorkHistoryCreditTypesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataEthnicAppearancesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

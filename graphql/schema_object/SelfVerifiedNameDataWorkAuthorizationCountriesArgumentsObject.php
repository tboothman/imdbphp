<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataWorkAuthorizationCountriesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

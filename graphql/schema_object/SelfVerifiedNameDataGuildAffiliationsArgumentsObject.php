<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataGuildAffiliationsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

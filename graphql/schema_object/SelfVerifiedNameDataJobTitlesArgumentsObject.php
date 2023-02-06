<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataJobTitlesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

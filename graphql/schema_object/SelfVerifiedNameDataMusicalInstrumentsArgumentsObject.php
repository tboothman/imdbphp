<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataMusicalInstrumentsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

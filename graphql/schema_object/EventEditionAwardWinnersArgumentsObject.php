<?php

namespace GraphQL\SchemaObject;

class EventEditionAwardWinnersArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

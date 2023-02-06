<?php

namespace GraphQL\SchemaObject;

class TrackCommentsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

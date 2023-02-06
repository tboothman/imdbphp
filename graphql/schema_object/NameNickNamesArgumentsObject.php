<?php

namespace GraphQL\SchemaObject;

class NameNickNamesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class NameManagedDataAutomaticKnownForArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class NamePrimaryProfessionsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

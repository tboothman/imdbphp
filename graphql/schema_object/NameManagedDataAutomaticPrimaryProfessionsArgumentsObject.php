<?php

namespace GraphQL\SchemaObject;

class NameManagedDataAutomaticPrimaryProfessionsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class RootCompaniesArgumentsObject extends ArgumentsObject
{
    protected $ids;

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }
}

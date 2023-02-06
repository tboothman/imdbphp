<?php

namespace GraphQL\SchemaObject;

class CompanyCreditCountriesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

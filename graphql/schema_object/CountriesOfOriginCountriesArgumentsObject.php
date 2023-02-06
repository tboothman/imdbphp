<?php

namespace GraphQL\SchemaObject;

class CountriesOfOriginCountriesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ImageCountriesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

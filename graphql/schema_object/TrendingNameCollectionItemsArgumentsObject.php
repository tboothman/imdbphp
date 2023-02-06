<?php

namespace GraphQL\SchemaObject;

class TrendingNameCollectionItemsArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class TrendingTitleCollectionItemsArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
<?php

namespace GraphQL\SchemaObject;

class TestTestItemsArgumentsObject extends ArgumentsObject
{
    protected $cachebuster;
    protected $limit;

    public function setCachebuster($cachebuster)
    {
        $this->cachebuster = $cachebuster;

        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}

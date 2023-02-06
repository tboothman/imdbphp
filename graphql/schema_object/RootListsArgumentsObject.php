<?php

namespace GraphQL\SchemaObject;

class RootListsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(ListFilterInputObject $listFilterInputObject)
    {
        $this->filter = $listFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

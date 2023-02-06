<?php

namespace GraphQL\SchemaObject;

class NameSharedNamesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;
    protected $input;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(SharedNamesFilterInputObject $sharedNamesFilterInputObject)
    {
        $this->filter = $sharedNamesFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setInput(SharedNamesInputInputObject $sharedNamesInputInputObject)
    {
        $this->input = $sharedNamesInputInputObject;

        return $this;
    }
}

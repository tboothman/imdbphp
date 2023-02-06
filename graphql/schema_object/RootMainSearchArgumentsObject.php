<?php

namespace GraphQL\SchemaObject;

class RootMainSearchArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;
    protected $options;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setOptions(MainSearchOptionsInputObject $mainSearchOptionsInputObject)
    {
        $this->options = $mainSearchOptionsInputObject;

        return $this;
    }
}

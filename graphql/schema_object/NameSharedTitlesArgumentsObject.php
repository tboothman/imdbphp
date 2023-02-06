<?php

namespace GraphQL\SchemaObject;

class NameSharedTitlesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;
    protected $input;

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

    public function setInput(SharedTitlesInputInputObject $sharedTitlesInputInputObject)
    {
        $this->input = $sharedTitlesInputInputObject;

        return $this;
    }
}

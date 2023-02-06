<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootNewsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $category;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setCategory($newsCategory)
    {
        $this->category = new RawObject($newsCategory);

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

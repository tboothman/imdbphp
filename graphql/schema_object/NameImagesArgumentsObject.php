<?php

namespace GraphQL\SchemaObject;

class NameImagesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $bust;
    protected $filter;
    protected $first;
    protected $jumpTo;
    protected $last;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setBust($bust)
    {
        $this->bust = $bust;

        return $this;
    }

    public function setFilter(ImagesFilterInputObject $imagesFilterInputObject)
    {
        $this->filter = $imagesFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setJumpTo($jumpTo)
    {
        $this->jumpTo = $jumpTo;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}

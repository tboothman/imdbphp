<?php

namespace GraphQL\SchemaObject;

class TitlePlotsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $filter;
    protected $first;
    protected $includeAllLocales;
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

    public function setFilter(FilterPlotsInputObject $filterPlotsInputObject)
    {
        $this->filter = $filterPlotsInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setIncludeAllLocales($includeAllLocales)
    {
        $this->includeAllLocales = $includeAllLocales;

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

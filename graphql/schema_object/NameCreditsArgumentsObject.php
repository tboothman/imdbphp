<?php

namespace GraphQL\SchemaObject;

class NameCreditsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $filter;
    protected $first;
    protected $last;
    protected $sort;

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

    public function setFilter(NameCreditsFilterInputObject $nameCreditsFilterInputObject)
    {
        $this->filter = $nameCreditsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }

    public function setSort(NameCreditSortInputObject $nameCreditSortInputObject)
    {
        $this->sort = $nameCreditSortInputObject;

        return $this;
    }
}

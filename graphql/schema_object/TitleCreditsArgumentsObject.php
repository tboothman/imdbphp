<?php

namespace GraphQL\SchemaObject;

class TitleCreditsArgumentsObject extends ArgumentsObject
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

    public function setFilter(TitleCreditsFilterInputObject $titleCreditsFilterInputObject)
    {
        $this->filter = $titleCreditsFilterInputObject;

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

    public function setSort(TitleCreditSortInputObject $titleCreditSortInputObject)
    {
        $this->sort = $titleCreditSortInputObject;

        return $this;
    }
}

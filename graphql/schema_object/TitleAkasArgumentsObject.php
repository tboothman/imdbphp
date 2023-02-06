<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class TitleAkasArgumentsObject extends ArgumentsObject
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

    public function setFilter($akaFilter)
    {
        $this->filter = new RawObject($akaFilter);

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

    public function setSort(AkaSortInputObject $akaSortInputObject)
    {
        $this->sort = $akaSortInputObject;

        return $this;
    }
}

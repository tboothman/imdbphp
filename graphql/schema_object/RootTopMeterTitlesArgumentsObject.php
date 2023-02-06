<?php

namespace GraphQL\SchemaObject;

class RootTopMeterTitlesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(TopMeterTitlesFilterInputObject $topMeterTitlesFilterInputObject)
    {
        $this->filter = $topMeterTitlesFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

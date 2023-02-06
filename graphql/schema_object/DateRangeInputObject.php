<?php

namespace GraphQL\SchemaObject;

class DateRangeInputObject extends InputObject
{
    protected $end;
    protected $start;

    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }
}

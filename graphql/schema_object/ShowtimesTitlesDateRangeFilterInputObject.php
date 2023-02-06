<?php

namespace GraphQL\SchemaObject;

class ShowtimesTitlesDateRangeFilterInputObject extends InputObject
{
    protected $startTime;

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }
}

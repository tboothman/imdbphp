<?php

namespace GraphQL\SchemaObject;

class RootBornTodayArgumentsObject extends ArgumentsObject
{
    protected $first;
    protected $today;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setToday($today)
    {
        $this->today = $today;

        return $this;
    }
}

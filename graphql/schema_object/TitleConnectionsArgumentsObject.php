<?php

namespace GraphQL\SchemaObject;

class TitleConnectionsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
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

    public function setFilter(ConnectionsFilterInputObject $connectionsFilterInputObject)
    {
        $this->filter = $connectionsFilterInputObject;

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

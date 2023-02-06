<?php

namespace GraphQL\SchemaObject;

class ContributorRankSortInputObject extends InputObject
{
    protected $by;
    protected $order;

    public function setBy($by)
    {
        $this->by = $by;

        return $this;
    }

    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class MeterRankChangeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MeterRankChange";

    public function selectChangeDirection()
    {
        $this->selectField("changeDirection");

        return $this;
    }

    public function selectDifference()
    {
        $this->selectField("difference");

        return $this;
    }
}

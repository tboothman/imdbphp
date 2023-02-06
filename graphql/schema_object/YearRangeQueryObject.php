<?php

namespace GraphQL\SchemaObject;

class YearRangeQueryObject extends QueryObject
{
    const OBJECT_NAME = "YearRange";

    public function selectEndYear()
    {
        $this->selectField("endYear");

        return $this;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}

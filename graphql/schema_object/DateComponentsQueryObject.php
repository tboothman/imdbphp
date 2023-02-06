<?php

namespace GraphQL\SchemaObject;

class DateComponentsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DateComponents";

    public function selectDay()
    {
        $this->selectField("day");

        return $this;
    }

    public function selectIsApproximate()
    {
        $this->selectField("isApproximate");

        return $this;
    }

    public function selectIsBCE()
    {
        $this->selectField("isBCE");

        return $this;
    }

    public function selectMonth()
    {
        $this->selectField("month");

        return $this;
    }

    public function selectPartialYear()
    {
        $this->selectField("partialYear");

        return $this;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}

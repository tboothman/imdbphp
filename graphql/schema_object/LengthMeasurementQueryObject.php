<?php

namespace GraphQL\SchemaObject;

class LengthMeasurementQueryObject extends QueryObject
{
    const OBJECT_NAME = "LengthMeasurement";

    public function selectUnit()
    {
        $this->selectField("unit");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}

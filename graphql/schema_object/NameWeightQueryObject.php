<?php

namespace GraphQL\SchemaObject;

class NameWeightQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameWeight";

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

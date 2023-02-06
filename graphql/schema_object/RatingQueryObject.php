<?php

namespace GraphQL\SchemaObject;

class RatingQueryObject extends QueryObject
{
    const OBJECT_NAME = "Rating";

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}

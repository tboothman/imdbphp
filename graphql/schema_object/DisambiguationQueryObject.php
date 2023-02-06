<?php

namespace GraphQL\SchemaObject;

class DisambiguationQueryObject extends QueryObject
{
    const OBJECT_NAME = "Disambiguation";

    public function selectNumber()
    {
        $this->selectField("number");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

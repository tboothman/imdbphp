<?php

namespace GraphQL\SchemaObject;

class TriviaCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TriviaCategory";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

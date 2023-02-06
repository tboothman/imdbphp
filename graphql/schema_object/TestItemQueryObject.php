<?php

namespace GraphQL\SchemaObject;

class TestItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestItem";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}

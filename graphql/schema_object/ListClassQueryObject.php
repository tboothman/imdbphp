<?php

namespace GraphQL\SchemaObject;

class ListClassQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListClass";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}

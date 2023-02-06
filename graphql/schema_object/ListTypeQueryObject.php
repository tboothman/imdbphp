<?php

namespace GraphQL\SchemaObject;

class ListTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListType";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}

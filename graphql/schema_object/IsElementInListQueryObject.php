<?php

namespace GraphQL\SchemaObject;

class IsElementInListQueryObject extends QueryObject
{
    const OBJECT_NAME = "IsElementInList";

    public function selectIsElementInList()
    {
        $this->selectField("isElementInList");

        return $this;
    }

    public function selectItemElementId()
    {
        $this->selectField("itemElementId");

        return $this;
    }
}

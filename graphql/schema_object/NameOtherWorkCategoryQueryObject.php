<?php

namespace GraphQL\SchemaObject;

class NameOtherWorkCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameOtherWorkCategory";

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

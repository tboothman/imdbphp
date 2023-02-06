<?php

namespace GraphQL\SchemaObject;

class GoofCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "GoofCategory";

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

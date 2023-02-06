<?php

namespace GraphQL\SchemaObject;

class AwardCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardCategory";

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

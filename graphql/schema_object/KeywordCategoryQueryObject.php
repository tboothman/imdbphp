<?php

namespace GraphQL\SchemaObject;

class KeywordCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "KeywordCategory";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}

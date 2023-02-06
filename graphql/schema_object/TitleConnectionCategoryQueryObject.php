<?php

namespace GraphQL\SchemaObject;

class TitleConnectionCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleConnectionCategory";

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

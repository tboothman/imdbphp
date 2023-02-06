<?php

namespace GraphQL\SchemaObject;

class ExternalLinkCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalLinkCategory";

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

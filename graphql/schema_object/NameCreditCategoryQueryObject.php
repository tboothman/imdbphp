<?php

namespace GraphQL\SchemaObject;

class NameCreditCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameCreditCategory";

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

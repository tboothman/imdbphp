<?php

namespace GraphQL\SchemaObject;

class CompanyCreditCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyCreditCategory";

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

<?php

namespace GraphQL\SchemaObject;

class PublicityListingCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "PublicityListingCategory";

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

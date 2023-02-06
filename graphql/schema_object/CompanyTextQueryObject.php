<?php

namespace GraphQL\SchemaObject;

class CompanyTextQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyText";

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

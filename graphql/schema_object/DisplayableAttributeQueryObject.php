<?php

namespace GraphQL\SchemaObject;

class DisplayableAttributeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableAttribute";

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

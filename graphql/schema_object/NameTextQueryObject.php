<?php

namespace GraphQL\SchemaObject;

class NameTextQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameText";

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

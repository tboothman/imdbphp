<?php

namespace GraphQL\SchemaObject;

class ListNameQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListName";

    public function selectOriginalText()
    {
        $this->selectField("originalText");

        return $this;
    }
}

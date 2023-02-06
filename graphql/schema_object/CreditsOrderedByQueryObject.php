<?php

namespace GraphQL\SchemaObject;

class CreditsOrderedByQueryObject extends QueryObject
{
    const OBJECT_NAME = "CreditsOrderedBy";

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

<?php

namespace GraphQL\SchemaObject;

class CreditsCompletenessStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "CreditsCompletenessStatus";

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

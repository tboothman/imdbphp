<?php

namespace GraphQL\SchemaObject;

class RestrictionExplanationQueryObject extends QueryObject
{
    const OBJECT_NAME = "RestrictionExplanation";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectReason()
    {
        $this->selectField("reason");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

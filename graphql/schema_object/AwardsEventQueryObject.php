<?php

namespace GraphQL\SchemaObject;

class AwardsEventQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardsEvent";

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

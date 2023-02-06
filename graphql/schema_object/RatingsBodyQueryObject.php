<?php

namespace GraphQL\SchemaObject;

class RatingsBodyQueryObject extends QueryObject
{
    const OBJECT_NAME = "RatingsBody";

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

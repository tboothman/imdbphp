<?php

namespace GraphQL\SchemaObject;

class CreditEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CreditEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }
}

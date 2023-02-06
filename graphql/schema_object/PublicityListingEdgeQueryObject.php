<?php

namespace GraphQL\SchemaObject;

class PublicityListingEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PublicityListingEdge";

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

<?php

namespace GraphQL\SchemaObject;

class DisplayableRegionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableRegion";

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

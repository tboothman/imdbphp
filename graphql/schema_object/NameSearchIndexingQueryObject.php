<?php

namespace GraphQL\SchemaObject;

class NameSearchIndexingQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameSearchIndexing";

    public function selectDisableIndexing()
    {
        $this->selectField("disableIndexing");

        return $this;
    }
}

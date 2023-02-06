<?php

namespace GraphQL\SchemaObject;

class RefTagQueryObject extends QueryObject
{
    const OBJECT_NAME = "RefTag";

    public function selectEp13nReftag()
    {
        $this->selectField("ep13nReftag");

        return $this;
    }
}

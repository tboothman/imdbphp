<?php

namespace GraphQL\SchemaObject;

class CinemasConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CinemasConnection";

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}

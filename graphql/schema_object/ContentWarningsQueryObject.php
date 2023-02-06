<?php

namespace GraphQL\SchemaObject;

class ContentWarningsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContentWarnings";

    public function selectIsPrimarilyAdultActor()
    {
        $this->selectField("isPrimarilyAdultActor");

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ModifiedByQueryObject extends QueryObject
{
    const OBJECT_NAME = "ModifiedBy";

    public function selectRole()
    {
        $this->selectField("role");

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class StaffStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "StaffStatus";

    public function selectCategory()
    {
        $this->selectField("category");

        return $this;
    }
}

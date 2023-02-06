<?php

namespace GraphQL\SchemaObject;

class ProStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProStatus";

    /**
     * @deprecated Use `hasSubscription`
     */
    public function select()
    {
        $this->selectField("_");

        return $this;
    }

    public function selectHasSubscription()
    {
        $this->selectField("hasSubscription");

        return $this;
    }
}

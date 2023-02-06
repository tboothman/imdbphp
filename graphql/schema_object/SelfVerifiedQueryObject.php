<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerified";

    public function selectIsSelfVerified()
    {
        $this->selectField("isSelfVerified");

        return $this;
    }
}

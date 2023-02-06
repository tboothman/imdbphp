<?php

namespace GraphQL\SchemaObject;

class TestAuthTimerQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestAuthTimer";

    public function selectAuthTimer()
    {
        $this->selectField("authTimer");

        return $this;
    }
}

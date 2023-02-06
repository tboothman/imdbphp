<?php

namespace GraphQL\SchemaObject;

class AgePlayingRangeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AgePlayingRange";

    public function selectFrom()
    {
        $this->selectField("from");

        return $this;
    }

    public function selectTo()
    {
        $this->selectField("to");

        return $this;
    }
}

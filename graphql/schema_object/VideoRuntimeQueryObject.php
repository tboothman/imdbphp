<?php

namespace GraphQL\SchemaObject;

class VideoRuntimeQueryObject extends QueryObject
{
    const OBJECT_NAME = "VideoRuntime";

    public function selectUnit()
    {
        $this->selectField("unit");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}

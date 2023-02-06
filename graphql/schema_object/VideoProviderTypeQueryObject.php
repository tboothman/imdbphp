<?php

namespace GraphQL\SchemaObject;

class VideoProviderTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "VideoProviderType";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}

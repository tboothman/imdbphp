<?php

namespace GraphQL\SchemaObject;

class MediaServiceImageQueryObject extends QueryObject
{
    const OBJECT_NAME = "MediaServiceImage";

    public function selectHeight()
    {
        $this->selectField("height");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectWidth()
    {
        $this->selectField("width");

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ThumbnailQueryObject extends QueryObject
{
    const OBJECT_NAME = "Thumbnail";

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

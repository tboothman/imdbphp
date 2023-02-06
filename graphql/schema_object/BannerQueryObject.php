<?php

namespace GraphQL\SchemaObject;

class BannerQueryObject extends QueryObject
{
    const OBJECT_NAME = "Banner";

    public function selectAttributionUrl()
    {
        $this->selectField("attributionUrl");

        return $this;
    }

    public function selectHeight()
    {
        $this->selectField("height");

        return $this;
    }

    public function selectImageUrl()
    {
        $this->selectField("imageUrl");

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

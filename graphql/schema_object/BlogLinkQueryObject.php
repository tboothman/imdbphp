<?php

namespace GraphQL\SchemaObject;

class BlogLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "BlogLink";

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}

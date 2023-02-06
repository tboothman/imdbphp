<?php

namespace GraphQL\SchemaObject;

class NewsLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "NewsLink";

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

<?php

namespace GraphQL\SchemaObject;

class TwitterLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "TwitterLink";

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

    public function selectUsername()
    {
        $this->selectField("username");

        return $this;
    }
}

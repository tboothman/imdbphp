<?php

namespace GraphQL\SchemaObject;

class ContributionLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributionLink";

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}

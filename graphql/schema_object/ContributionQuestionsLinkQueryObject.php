<?php

namespace GraphQL\SchemaObject;

class ContributionQuestionsLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributionQuestionsLink";

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}

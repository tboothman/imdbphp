<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardPeriodTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboardPeriodType";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}

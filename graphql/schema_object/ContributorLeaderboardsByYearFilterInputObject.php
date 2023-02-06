<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsByYearFilterInputObject extends InputObject
{
    protected $years;

    public function setYears(array $years)
    {
        $this->years = $years;

        return $this;
    }
}

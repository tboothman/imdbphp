<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsYearArgumentsObject extends ArgumentsObject
{
    protected $year;

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }
}

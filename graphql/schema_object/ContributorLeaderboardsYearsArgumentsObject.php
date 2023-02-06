<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsYearsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(ContributorLeaderboardsByYearFilterInputObject $contributorLeaderboardsByYearFilterInputObject)
    {
        $this->filter = $contributorLeaderboardsByYearFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

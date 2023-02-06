<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsMonthsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(ContributorLeaderboardsByMonthFilterInputObject $contributorLeaderboardsByMonthFilterInputObject)
    {
        $this->filter = $contributorLeaderboardsByMonthFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

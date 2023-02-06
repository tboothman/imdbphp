<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardRankingsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $filter;
    protected $first;
    protected $jumpTo;
    protected $last;
    protected $sort;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFilter(ContributorLeaderboardRankingsFilterInputObject $contributorLeaderboardRankingsFilterInputObject)
    {
        $this->filter = $contributorLeaderboardRankingsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setJumpTo($jumpTo)
    {
        $this->jumpTo = $jumpTo;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }

    public function setSort(ContributorRankSortInputObject $contributorRankSortInputObject)
    {
        $this->sort = $contributorRankSortInputObject;

        return $this;
    }
}

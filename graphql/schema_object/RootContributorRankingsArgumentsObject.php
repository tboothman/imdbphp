<?php

namespace GraphQL\SchemaObject;

class RootContributorRankingsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(ContributorRankingsFilterInputObject $contributorRankingsFilterInputObject)
    {
        $this->filter = $contributorRankingsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}

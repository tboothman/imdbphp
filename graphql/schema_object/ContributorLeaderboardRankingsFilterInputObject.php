<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardRankingsFilterInputObject extends InputObject
{
    protected $maximumRank;

    public function setMaximumRank($maximumRank)
    {
        $this->maximumRank = $maximumRank;

        return $this;
    }
}

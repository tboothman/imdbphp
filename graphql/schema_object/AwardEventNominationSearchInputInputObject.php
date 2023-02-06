<?php

namespace GraphQL\SchemaObject;

class AwardEventNominationSearchInputInputObject extends InputObject
{
    protected $eventId;
    protected $searchAwardCategoryId;
    protected $winnerFilter;

    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function setSearchAwardCategoryId($searchAwardCategoryId)
    {
        $this->searchAwardCategoryId = $searchAwardCategoryId;

        return $this;
    }

    public function setWinnerFilter($winnerFilter)
    {
        $this->winnerFilter = $winnerFilter;

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class AwardNominationsFilterInputObject extends InputObject
{
    protected $awards;
    protected $events;
    protected $wins;

    public function setAwards(array $awards)
    {
        $this->awards = $awards;

        return $this;
    }

    public function setEvents(array $events)
    {
        $this->events = $events;

        return $this;
    }

    public function setWins($wins)
    {
        $this->wins = $wins;

        return $this;
    }
}

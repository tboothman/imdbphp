<?php

namespace GraphQL\SchemaObject;

class EpisodeReleaseDateInputObject extends InputObject
{
    protected $day;
    protected $month;
    protected $year;

    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }
}

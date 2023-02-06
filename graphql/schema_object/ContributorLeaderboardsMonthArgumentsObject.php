<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsMonthArgumentsObject extends ArgumentsObject
{
    protected $month;
    protected $year;

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

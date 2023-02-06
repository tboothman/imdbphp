<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsByMonthFilterInputObject extends InputObject
{
    protected $months;
    protected $years;

    public function setMonths(array $months)
    {
        $this->months = $months;

        return $this;
    }

    public function setYears(array $years)
    {
        $this->years = $years;

        return $this;
    }
}

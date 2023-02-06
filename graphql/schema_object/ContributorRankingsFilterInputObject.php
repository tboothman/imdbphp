<?php

namespace GraphQL\SchemaObject;

class ContributorRankingsFilterInputObject extends InputObject
{
    protected $contributorId;
    protected $months;
    protected $period;
    protected $years;

    public function setContributorId($contributorId)
    {
        $this->contributorId = $contributorId;

        return $this;
    }

    public function setMonths(array $months)
    {
        $this->months = $months;

        return $this;
    }

    public function setPeriod(array $period)
    {
        $this->period = $period;

        return $this;
    }

    public function setYears(array $years)
    {
        $this->years = $years;

        return $this;
    }
}

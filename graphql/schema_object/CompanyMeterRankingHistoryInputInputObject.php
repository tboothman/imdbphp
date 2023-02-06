<?php

namespace GraphQL\SchemaObject;

class CompanyMeterRankingHistoryInputInputObject extends InputObject
{
    protected $endDate;
    protected $startDate;

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }
}

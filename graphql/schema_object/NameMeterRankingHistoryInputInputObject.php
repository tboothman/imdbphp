<?php

namespace GraphQL\SchemaObject;

class NameMeterRankingHistoryInputInputObject extends InputObject
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

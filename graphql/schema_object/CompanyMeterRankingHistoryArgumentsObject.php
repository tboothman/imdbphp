<?php

namespace GraphQL\SchemaObject;

class CompanyMeterRankingHistoryArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(CompanyMeterRankingHistoryInputInputObject $companyMeterRankingHistoryInputInputObject)
    {
        $this->input = $companyMeterRankingHistoryInputInputObject;

        return $this;
    }
}

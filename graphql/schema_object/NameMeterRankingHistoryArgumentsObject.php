<?php

namespace GraphQL\SchemaObject;

class NameMeterRankingHistoryArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(NameMeterRankingHistoryInputInputObject $nameMeterRankingHistoryInputInputObject)
    {
        $this->input = $nameMeterRankingHistoryInputInputObject;

        return $this;
    }
}

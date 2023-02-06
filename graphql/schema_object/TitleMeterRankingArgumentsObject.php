<?php

namespace GraphQL\SchemaObject;

class TitleMeterRankingArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(TitleMeterRankingInputInputObject $titleMeterRankingInputInputObject)
    {
        $this->input = $titleMeterRankingInputInputObject;

        return $this;
    }
}

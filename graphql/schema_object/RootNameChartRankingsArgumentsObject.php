<?php

namespace GraphQL\SchemaObject;

class RootNameChartRankingsArgumentsObject extends ArgumentsObject
{
    protected $first;
    protected $input;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setInput(NameChartRankingsInputInputObject $nameChartRankingsInputInputObject)
    {
        $this->input = $nameChartRankingsInputInputObject;

        return $this;
    }
}

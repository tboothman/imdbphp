<?php

namespace GraphQL\SchemaObject;

class RootTitleChartRankingsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;
    protected $input;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setInput(TitleChartRankingsInputInputObject $titleChartRankingsInputInputObject)
    {
        $this->input = $titleChartRankingsInputInputObject;

        return $this;
    }
}

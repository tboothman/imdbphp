<?php

namespace GraphQL\SchemaObject;

class TitleChartRankingsInputInputObject extends InputObject
{
    protected $rankingsChartType;

    public function setRankingsChartType($rankingsChartType)
    {
        $this->rankingsChartType = $rankingsChartType;

        return $this;
    }
}

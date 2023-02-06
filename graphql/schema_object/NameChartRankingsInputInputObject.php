<?php

namespace GraphQL\SchemaObject;

class NameChartRankingsInputInputObject extends InputObject
{
    protected $rankingsChartType;

    public function setRankingsChartType($rankingsChartType)
    {
        $this->rankingsChartType = $rankingsChartType;

        return $this;
    }
}

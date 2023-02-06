<?php

namespace GraphQL\SchemaObject;

class AggregateRatingsBreakdownHistogramArgumentsObject extends ArgumentsObject
{
    protected $demographicFilter;

    public function setDemographicFilter(DemographicFilterInputObject $demographicFilterInputObject)
    {
        $this->demographicFilter = $demographicFilterInputObject;

        return $this;
    }
}

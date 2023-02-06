<?php

namespace GraphQL\SchemaObject;

class AggregateRatingsBreakdownQueryObject extends QueryObject
{
    const OBJECT_NAME = "AggregateRatingsBreakdown";

    public function selectHistogram(AggregateRatingsBreakdownHistogramArgumentsObject $argsObject = null)
    {
        $object = new HistogramQueryObject("histogram");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsCollapsed()
    {
        $this->selectField("isCollapsed");

        return $this;
    }

    public function selectRatingsSummaryByDemographics(AggregateRatingsBreakdownRatingsSummaryByDemographicsArgumentsObject $argsObject = null)
    {
        $object = new DemographicRatingsQueryObject("ratingsSummaryByDemographics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

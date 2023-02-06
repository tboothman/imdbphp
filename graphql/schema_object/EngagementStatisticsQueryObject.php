<?php

namespace GraphQL\SchemaObject;

class EngagementStatisticsQueryObject extends QueryObject
{
    const OBJECT_NAME = "EngagementStatistics";

    public function selectWatchlistStatistics(EngagementStatisticsWatchlistStatisticsArgumentsObject $argsObject = null)
    {
        $object = new WatchlistStatisticsQueryObject("watchlistStatistics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

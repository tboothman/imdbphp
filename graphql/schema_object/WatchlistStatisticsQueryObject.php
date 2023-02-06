<?php

namespace GraphQL\SchemaObject;

class WatchlistStatisticsQueryObject extends QueryObject
{
    const OBJECT_NAME = "WatchlistStatistics";

    public function selectDisplayableCount(WatchlistStatisticsDisplayableCountArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableCountQueryObject("displayableCount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalCount()
    {
        $this->selectField("totalCount");

        return $this;
    }
}

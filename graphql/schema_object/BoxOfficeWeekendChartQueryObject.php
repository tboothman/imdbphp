<?php

namespace GraphQL\SchemaObject;

class BoxOfficeWeekendChartQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoxOfficeWeekendChart";

    public function selectEntries(BoxOfficeWeekendChartEntriesArgumentsObject $argsObject = null)
    {
        $object = new ChartEntryQueryObject("entries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWeekendEndDate()
    {
        $this->selectField("weekendEndDate");

        return $this;
    }

    public function selectWeekendStartDate()
    {
        $this->selectField("weekendStartDate");

        return $this;
    }
}

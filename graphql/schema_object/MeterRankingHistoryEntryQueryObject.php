<?php

namespace GraphQL\SchemaObject;

class MeterRankingHistoryEntryQueryObject extends QueryObject
{
    const OBJECT_NAME = "MeterRankingHistoryEntry";

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectEvents(MeterRankingHistoryEntryEventsArgumentsObject $argsObject = null)
    {
        $object = new MeterEventQueryObject("events");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRank()
    {
        $this->selectField("rank");

        return $this;
    }
}

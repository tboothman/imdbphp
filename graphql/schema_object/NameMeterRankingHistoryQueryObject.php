<?php

namespace GraphQL\SchemaObject;

class NameMeterRankingHistoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameMeterRankingHistory";

    public function selectRanks(NameMeterRankingHistoryRanksArgumentsObject $argsObject = null)
    {
        $object = new MeterRankingHistoryEntryQueryObject("ranks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(NameMeterRankingHistoryRestrictionArgumentsObject $argsObject = null)
    {
        $object = new MeterRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

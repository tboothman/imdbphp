<?php

namespace GraphQL\SchemaObject;

class CompanyMeterRankingHistoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyMeterRankingHistory";

    public function selectRanks(CompanyMeterRankingHistoryRanksArgumentsObject $argsObject = null)
    {
        $object = new MeterRankingHistoryEntryQueryObject("ranks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(CompanyMeterRankingHistoryRestrictionArgumentsObject $argsObject = null)
    {
        $object = new MeterRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

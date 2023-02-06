<?php

namespace GraphQL\SchemaObject;

class CompanyMeterRankingQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyMeterRanking";

    public function selectCurrentRank()
    {
        $this->selectField("currentRank");

        return $this;
    }

    public function selectRankChange(CompanyMeterRankingRankChangeArgumentsObject $argsObject = null)
    {
        $object = new MeterRankChangeQueryObject("rankChange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

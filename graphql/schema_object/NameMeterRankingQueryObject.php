<?php

namespace GraphQL\SchemaObject;

class NameMeterRankingQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameMeterRanking";

    public function selectCurrentRank()
    {
        $this->selectField("currentRank");

        return $this;
    }

    public function selectRankChange(NameMeterRankingRankChangeArgumentsObject $argsObject = null)
    {
        $object = new MeterRankChangeQueryObject("rankChange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

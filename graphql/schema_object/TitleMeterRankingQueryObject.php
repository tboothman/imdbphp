<?php

namespace GraphQL\SchemaObject;

class TitleMeterRankingQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleMeterRanking";

    public function selectCurrentRank()
    {
        $this->selectField("currentRank");

        return $this;
    }

    public function selectMeterType()
    {
        $this->selectField("meterType");

        return $this;
    }

    public function selectRankChange(TitleMeterRankingRankChangeArgumentsObject $argsObject = null)
    {
        $object = new MeterRankChangeQueryObject("rankChange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class PrestigiousAwardSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrestigiousAwardSummary";

    public function selectAward(PrestigiousAwardSummaryAwardArgumentsObject $argsObject = null)
    {
        $object = new AwardDetailsQueryObject("award");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNominations()
    {
        $this->selectField("nominations");

        return $this;
    }

    public function selectWins()
    {
        $this->selectField("wins");

        return $this;
    }
}

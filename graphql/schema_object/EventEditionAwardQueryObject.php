<?php

namespace GraphQL\SchemaObject;

class EventEditionAwardQueryObject extends QueryObject
{
    const OBJECT_NAME = "EventEditionAward";

    public function selectAwardName()
    {
        $this->selectField("awardName");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectWinners(EventEditionAwardWinnersArgumentsObject $argsObject = null)
    {
        $object = new AwardNominationQueryObject("winners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

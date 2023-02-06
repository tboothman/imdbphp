<?php

namespace GraphQL\SchemaObject;

class AwardDetailsQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardDetails";

    public function selectCategory(AwardDetailsCategoryArgumentsObject $argsObject = null)
    {
        $object = new AwardCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEvent(AwardDetailsEventArgumentsObject $argsObject = null)
    {
        $object = new AwardsEventQueryObject("event");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEventEditionId()
    {
        $this->selectField("eventEditionId");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }

    public function selectWinningRank()
    {
        $this->selectField("winningRank");

        return $this;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}

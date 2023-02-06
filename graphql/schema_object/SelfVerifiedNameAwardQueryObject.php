<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameAwardQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameAward";

    public function selectDetails(SelfVerifiedNameAwardDetailsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("details");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEvent(SelfVerifiedNameAwardEventArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("event");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName(SelfVerifiedNameAwardNameArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}

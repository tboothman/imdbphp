<?php

namespace GraphQL\SchemaObject;

class NameDeathQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameDeath";

    public function selectCause(NameDeathCauseArgumentsObject $argsObject = null)
    {
        $object = new DeathCauseQueryObject("cause");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectLocation(NameDeathLocationArgumentsObject $argsObject = null)
    {
        $object = new LocationQueryObject("location");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

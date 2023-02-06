<?php

namespace GraphQL\SchemaObject;

class NameBirthQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameBirth";

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectLocation(NameBirthLocationArgumentsObject $argsObject = null)
    {
        $object = new LocationQueryObject("location");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

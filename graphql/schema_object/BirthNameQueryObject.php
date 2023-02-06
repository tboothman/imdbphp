<?php

namespace GraphQL\SchemaObject;

class BirthNameQueryObject extends QueryObject
{
    const OBJECT_NAME = "BirthName";

    public function selectDisplayableProperty(BirthNameDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableBirthNamePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

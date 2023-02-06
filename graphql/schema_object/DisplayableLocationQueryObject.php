<?php

namespace GraphQL\SchemaObject;

class DisplayableLocationQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableLocation";

    public function selectDisplayableProperty(DisplayableLocationDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLocationPropertyQueryObject("displayableProperty");
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

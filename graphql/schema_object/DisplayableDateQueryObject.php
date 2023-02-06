<?php

namespace GraphQL\SchemaObject;

class DisplayableDateQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableDate";

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectDateComponents(DisplayableDateDateComponentsArgumentsObject $argsObject = null)
    {
        $object = new DateComponentsQueryObject("dateComponents");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(DisplayableDateDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDatePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

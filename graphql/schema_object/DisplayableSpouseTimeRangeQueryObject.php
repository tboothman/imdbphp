<?php

namespace GraphQL\SchemaObject;

class DisplayableSpouseTimeRangeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableSpouseTimeRange";

    public function selectDisplayableProperty(DisplayableSpouseTimeRangeDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableSpouseTimeRangePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFromDate(DisplayableSpouseTimeRangeFromDateArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDateQueryObject("fromDate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectToDate(DisplayableSpouseTimeRangeToDateArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDateQueryObject("toDate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ChartEntryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ChartEntry";

    public function selectTitle(ChartEntryTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWeekendGross(ChartEntryWeekendGrossArgumentsObject $argsObject = null)
    {
        $object = new BoxOfficeGrossQueryObject("weekendGross");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class MeterEventQueryObject extends QueryObject
{
    const OBJECT_NAME = "MeterEvent";

    public function selectTitle(MeterEventTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType(MeterEventTypeArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("type");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

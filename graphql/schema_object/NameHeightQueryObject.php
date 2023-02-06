<?php

namespace GraphQL\SchemaObject;

class NameHeightQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameHeight";

    public function selectDisplayableProperty(NameHeightDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameHeightPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeasurement(NameHeightMeasurementArgumentsObject $argsObject = null)
    {
        $object = new LengthMeasurementQueryObject("measurement");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

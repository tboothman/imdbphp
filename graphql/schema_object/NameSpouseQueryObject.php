<?php

namespace GraphQL\SchemaObject;

class NameSpouseQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameSpouse";

    public function selectAttributes(NameSpouseAttributesArgumentsObject $argsObject = null)
    {
        $object = new SpouseAttributesQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCurrent()
    {
        $this->selectField("current");

        return $this;
    }

    public function selectDisplayableProperty(NameSpouseDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameSpousePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpouse(NameSpouseSpouseArgumentsObject $argsObject = null)
    {
        $object = new SpouseNameQueryObject("spouse");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimeRange(NameSpouseTimeRangeArgumentsObject $argsObject = null)
    {
        $object = new DisplayableSpouseTimeRangeQueryObject("timeRange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

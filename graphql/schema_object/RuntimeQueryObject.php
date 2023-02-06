<?php

namespace GraphQL\SchemaObject;

class RuntimeQueryObject extends QueryObject
{
    const OBJECT_NAME = "Runtime";

    public function selectAttributes(RuntimeAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountry(RuntimeCountryArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("country");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(RuntimeDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleRuntimePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectSeconds()
    {
        $this->selectField("seconds");

        return $this;
    }
}

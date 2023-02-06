<?php

namespace GraphQL\SchemaObject;

class DisplayableSalaryPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableSalaryProperty";

    public function selectKey(DisplayableSalaryPropertyKeyArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("key");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableSalaryPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

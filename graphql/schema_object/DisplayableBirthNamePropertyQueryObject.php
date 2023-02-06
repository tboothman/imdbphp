<?php

namespace GraphQL\SchemaObject;

class DisplayableBirthNamePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableBirthNameProperty";

    public function selectValue(DisplayableBirthNamePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

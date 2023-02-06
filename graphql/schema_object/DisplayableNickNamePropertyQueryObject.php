<?php

namespace GraphQL\SchemaObject;

class DisplayableNickNamePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableNickNameProperty";

    public function selectValue(DisplayableNickNamePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

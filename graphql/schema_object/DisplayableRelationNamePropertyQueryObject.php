<?php

namespace GraphQL\SchemaObject;

class DisplayableRelationNamePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableRelationNameProperty";

    public function selectValue(DisplayableRelationNamePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

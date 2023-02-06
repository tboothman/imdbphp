<?php

namespace GraphQL\SchemaObject;

class DisplayableNameAgeDetailsPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableNameAgeDetailsProperty";

    public function selectValue(DisplayableNameAgeDetailsPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

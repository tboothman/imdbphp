<?php

namespace GraphQL\SchemaObject;

class DisplayableNameAkaPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableNameAkaProperty";

    public function selectValue(DisplayableNameAkaPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class DisplayableTitleTypePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTitleTypeProperty";

    public function selectValue(DisplayableTitleTypePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

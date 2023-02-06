<?php

namespace GraphQL\SchemaObject;

class DisplayableTitleTaglinePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTitleTaglineProperty";

    public function selectValue(DisplayableTitleTaglinePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

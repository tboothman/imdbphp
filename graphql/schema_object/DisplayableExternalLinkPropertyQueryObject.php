<?php

namespace GraphQL\SchemaObject;

class DisplayableExternalLinkPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableExternalLinkProperty";

    public function selectValue(DisplayableExternalLinkPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

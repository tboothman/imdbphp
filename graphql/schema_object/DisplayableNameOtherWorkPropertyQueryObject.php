<?php

namespace GraphQL\SchemaObject;

class DisplayableNameOtherWorkPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableNameOtherWorkProperty";

    public function selectQualifiersInMarkdownList(DisplayableNameOtherWorkPropertyQualifiersInMarkdownListArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("qualifiersInMarkdownList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableNameOtherWorkPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

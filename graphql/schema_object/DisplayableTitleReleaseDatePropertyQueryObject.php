<?php

namespace GraphQL\SchemaObject;

class DisplayableTitleReleaseDatePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTitleReleaseDateProperty";

    public function selectKey(DisplayableTitleReleaseDatePropertyKeyArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("key");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQualifiersInMarkdownList(DisplayableTitleReleaseDatePropertyQualifiersInMarkdownListArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("qualifiersInMarkdownList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableTitleReleaseDatePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

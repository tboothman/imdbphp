<?php

namespace GraphQL\SchemaObject;

class DisplayableTechnicalSpecificationPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTechnicalSpecificationProperty";

    public function selectQualifiersInMarkdownList(DisplayableTechnicalSpecificationPropertyQualifiersInMarkdownListArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("qualifiersInMarkdownList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableTechnicalSpecificationPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

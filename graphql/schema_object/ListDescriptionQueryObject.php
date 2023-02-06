<?php

namespace GraphQL\SchemaObject;

class ListDescriptionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListDescription";

    public function selectOriginalText(ListDescriptionOriginalTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("originalText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

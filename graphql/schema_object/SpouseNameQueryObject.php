<?php

namespace GraphQL\SchemaObject;

class SpouseNameQueryObject extends QueryObject
{
    const OBJECT_NAME = "SpouseName";

    public function selectAsMarkdown(SpouseNameAsMarkdownArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("asMarkdown");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName(SpouseNameNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class LocalizedMarkdownQueryObject extends QueryObject
{
    const OBJECT_NAME = "LocalizedMarkdown";

    public function selectLanguage()
    {
        $this->selectField("language");

        return $this;
    }

    public function selectValue(LocalizedMarkdownValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class DisplayableNameSpousePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableNameSpouseProperty";

    public function selectLanguage(DisplayableNameSpousePropertyLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQualifiersInMarkdownList(DisplayableNameSpousePropertyQualifiersInMarkdownListArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("qualifiersInMarkdownList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableNameSpousePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

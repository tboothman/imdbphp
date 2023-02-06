<?php

namespace GraphQL\SchemaObject;

class DisplayableTitleSpokenLanguagePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTitleSpokenLanguageProperty";

    public function selectLanguage(DisplayableTitleSpokenLanguagePropertyLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableTitleSpokenLanguagePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

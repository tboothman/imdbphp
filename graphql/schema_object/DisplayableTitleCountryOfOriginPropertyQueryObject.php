<?php

namespace GraphQL\SchemaObject;

class DisplayableTitleCountryOfOriginPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTitleCountryOfOriginProperty";

    public function selectLanguage(DisplayableTitleCountryOfOriginPropertyLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableTitleCountryOfOriginPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

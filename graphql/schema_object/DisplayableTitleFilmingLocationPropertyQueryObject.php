<?php

namespace GraphQL\SchemaObject;

class DisplayableTitleFilmingLocationPropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableTitleFilmingLocationProperty";

    public function selectLanguage(DisplayableTitleFilmingLocationPropertyLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQualifiersInMarkdownList(DisplayableTitleFilmingLocationPropertyQualifiersInMarkdownListArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("qualifiersInMarkdownList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableTitleFilmingLocationPropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

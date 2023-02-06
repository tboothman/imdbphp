<?php

namespace GraphQL\SchemaObject;

class DisplayableSpouseTimeRangePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableSpouseTimeRangeProperty";

    public function selectLanguage(DisplayableSpouseTimeRangePropertyLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DisplayableSpouseTimeRangePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

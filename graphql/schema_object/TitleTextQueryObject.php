<?php

namespace GraphQL\SchemaObject;

class TitleTextQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleText";

    public function selectCountry(TitleTextCountryArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("country");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsOriginalTitle()
    {
        $this->selectField("isOriginalTitle");

        return $this;
    }

    public function selectLanguage(TitleTextLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

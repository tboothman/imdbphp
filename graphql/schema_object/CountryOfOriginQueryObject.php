<?php

namespace GraphQL\SchemaObject;

class CountryOfOriginQueryObject extends QueryObject
{
    const OBJECT_NAME = "CountryOfOrigin";

    public function selectDisplayableProperty(CountryOfOriginDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleCountryOfOriginPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(CountryOfOriginLanguageArgumentsObject $argsObject = null)
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

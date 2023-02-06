<?php

namespace GraphQL\SchemaObject;

class CountriesOfOriginQueryObject extends QueryObject
{
    const OBJECT_NAME = "CountriesOfOrigin";

    public function selectCountries(CountriesOfOriginCountriesArgumentsObject $argsObject = null)
    {
        $object = new CountryOfOriginQueryObject("countries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLanguage(CountriesOfOriginLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

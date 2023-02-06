<?php

namespace GraphQL\SchemaObject;

class SpokenLanguagesQueryObject extends QueryObject
{
    const OBJECT_NAME = "SpokenLanguages";

    public function selectLanguage(SpokenLanguagesLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpokenLanguages(SpokenLanguagesSpokenLanguagesArgumentsObject $argsObject = null)
    {
        $object = new SpokenLanguageQueryObject("spokenLanguages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

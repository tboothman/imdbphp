<?php

namespace GraphQL\SchemaObject;

class LocalizedDisplayableSeasonQueryObject extends QueryObject
{
    const OBJECT_NAME = "LocalizedDisplayableSeason";

    public function selectDisplayableProperty(LocalizedDisplayableSeasonDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new SeasonValueDisplayablePropertyQueryObject("displayableProperty");
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

    public function selectLanguage(LocalizedDisplayableSeasonLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSeason()
    {
        $this->selectField("season");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}

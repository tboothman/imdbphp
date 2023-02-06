<?php

namespace GraphQL\SchemaObject;

class LocalizedDisplayableEpisodeYearQueryObject extends QueryObject
{
    const OBJECT_NAME = "LocalizedDisplayableEpisodeYear";

    public function selectDisplayableProperty(LocalizedDisplayableEpisodeYearDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new YearDisplayablePropertyQueryObject("displayableProperty");
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

    public function selectLanguage(LocalizedDisplayableEpisodeYearLanguageArgumentsObject $argsObject = null)
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

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}

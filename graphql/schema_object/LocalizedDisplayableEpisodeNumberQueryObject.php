<?php

namespace GraphQL\SchemaObject;

class LocalizedDisplayableEpisodeNumberQueryObject extends QueryObject
{
    const OBJECT_NAME = "LocalizedDisplayableEpisodeNumber";

    public function selectDisplayableProperty(LocalizedDisplayableEpisodeNumberDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new EpisodeNumberDisplayablePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpisodeNumber()
    {
        $this->selectField("episodeNumber");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(LocalizedDisplayableEpisodeNumberLanguageArgumentsObject $argsObject = null)
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

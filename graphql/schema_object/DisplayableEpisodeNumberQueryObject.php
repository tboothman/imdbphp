<?php

namespace GraphQL\SchemaObject;

class DisplayableEpisodeNumberQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableEpisodeNumber";

    public function selectDisplayableSeason(DisplayableEpisodeNumberDisplayableSeasonArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableSeasonQueryObject("displayableSeason");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpisodeNumber(DisplayableEpisodeNumberEpisodeNumberArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableEpisodeNumberQueryObject("episodeNumber");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

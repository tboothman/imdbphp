<?php

namespace GraphQL\SchemaObject;

class EpisodesQueryObject extends QueryObject
{
    const OBJECT_NAME = "Episodes";

    public function selectDisplayableSeasons(EpisodesDisplayableSeasonsArgumentsObject $argsObject = null)
    {
        $object = new DisplayableSeasonConnectionQueryObject("displayableSeasons");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableYears(EpisodesDisplayableYearsArgumentsObject $argsObject = null)
    {
        $object = new DisplayableYearConnectionQueryObject("displayableYears");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpisodes(EpisodesEpisodesArgumentsObject $argsObject = null)
    {
        $object = new EpisodeConnectionQueryObject("episodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsOngoing()
    {
        $this->selectField("isOngoing");

        return $this;
    }

    /**
     * @deprecated Use displayableSeasons instead
     */
    public function selectSeasons(EpisodesSeasonsArgumentsObject $argsObject = null)
    {
        $object = new EpisodesSeasonQueryObject("seasons");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use displayableYears instead
     */
    public function selectYears(EpisodesYearsArgumentsObject $argsObject = null)
    {
        $object = new EpisodesYearQueryObject("years");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class SeriesQueryObject extends QueryObject
{
    const OBJECT_NAME = "Series";

    public function selectDisplayableEpisodeNumber(SeriesDisplayableEpisodeNumberArgumentsObject $argsObject = null)
    {
        $object = new DisplayableEpisodeNumberQueryObject("displayableEpisodeNumber");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use displayableEpisodeNumber instead
     */
    public function selectEpisodeNumber(SeriesEpisodeNumberArgumentsObject $argsObject = null)
    {
        $object = new EpisodeNumberQueryObject("episodeNumber");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNextEpisode(SeriesNextEpisodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("nextEpisode");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPreviousEpisode(SeriesPreviousEpisodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("previousEpisode");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSeries(SeriesSeriesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("series");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

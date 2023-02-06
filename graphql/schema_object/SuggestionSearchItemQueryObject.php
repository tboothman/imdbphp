<?php

namespace GraphQL\SchemaObject;

class SuggestionSearchItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "SuggestionSearchItem";

    public function selectConstId()
    {
        $this->selectField("constId");

        return $this;
    }

    public function selectDisplayLabels(SuggestionSearchItemDisplayLabelsArgumentsObject $argsObject = null)
    {
        $object = new DisplayLabelsQueryObject("displayLabels");
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

    public function selectImage(SuggestionSearchItemImageArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("image");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRank()
    {
        $this->selectField("rank");

        return $this;
    }

    public function selectRefTagFragment()
    {
        $this->selectField("refTagFragment");

        return $this;
    }

    public function selectReleaseYear(SuggestionSearchItemReleaseYearArgumentsObject $argsObject = null)
    {
        $object = new YearRangeQueryObject("releaseYear");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleTypeId()
    {
        $this->selectField("titleTypeId");

        return $this;
    }

    public function selectTopVideos(SuggestionSearchItemTopVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoMediaQueryObject("topVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectVideoCount()
    {
        $this->selectField("videoCount");

        return $this;
    }
}

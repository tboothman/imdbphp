<?php

namespace GraphQL\SchemaObject;

class TitleTrackRecommendationsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTrackRecommendationsConnection";

    public function selectEdges(TitleTrackRecommendationsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleTrackRecommendationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleTrackRecommendationsConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}

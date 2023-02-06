<?php

namespace GraphQL\SchemaObject;

class NameTrackRecommendationsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameTrackRecommendationsConnection";

    public function selectEdges(NameTrackRecommendationsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameTrackRecommendationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameTrackRecommendationsConnectionPageInfoArgumentsObject $argsObject = null)
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

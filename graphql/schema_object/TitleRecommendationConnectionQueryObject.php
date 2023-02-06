<?php

namespace GraphQL\SchemaObject;

class TitleRecommendationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleRecommendationConnection";

    public function selectEdges(TitleRecommendationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleRecommendationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleRecommendationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

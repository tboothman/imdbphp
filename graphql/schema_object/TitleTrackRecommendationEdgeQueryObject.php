<?php

namespace GraphQL\SchemaObject;

class TitleTrackRecommendationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTrackRecommendationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleTrackRecommendationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }
}

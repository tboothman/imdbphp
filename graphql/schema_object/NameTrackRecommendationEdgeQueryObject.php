<?php

namespace GraphQL\SchemaObject;

class NameTrackRecommendationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameTrackRecommendationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameTrackRecommendationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("node");
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

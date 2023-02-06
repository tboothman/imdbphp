<?php

namespace GraphQL\SchemaObject;

class TitleRecommendationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleRecommendationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleRecommendationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleRecommendationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class MetacriticReviewEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetacriticReviewEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MetacriticReviewEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MetacriticReviewQueryObject("node");
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

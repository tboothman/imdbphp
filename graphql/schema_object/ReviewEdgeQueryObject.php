<?php

namespace GraphQL\SchemaObject;

class ReviewEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReviewEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ReviewEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ReviewQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

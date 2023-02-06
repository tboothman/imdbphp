<?php

namespace GraphQL\SchemaObject;

class TrendingVideoEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingVideoEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TrendingVideoEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TrendingVideoNodeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

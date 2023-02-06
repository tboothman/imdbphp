<?php

namespace GraphQL\SchemaObject;

class TrendingTitleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingTitleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TrendingTitleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleNodeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

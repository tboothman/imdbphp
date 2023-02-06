<?php

namespace GraphQL\SchemaObject;

class RecentlyViewedEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RecentlyViewedEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RecentlyViewedEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RecentlyViewedItemUnionObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class TrendingNameEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingNameEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TrendingNameEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TrendingNameNodeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

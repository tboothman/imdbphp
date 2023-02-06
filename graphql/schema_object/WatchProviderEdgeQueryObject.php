<?php

namespace GraphQL\SchemaObject;

class WatchProviderEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "WatchProviderEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(WatchProviderEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new WatchProviderQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

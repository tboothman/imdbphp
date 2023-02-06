<?php

namespace GraphQL\SchemaObject;

class LivingRoomGameEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomGameEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(LivingRoomGameEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameQueryObject("node");
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

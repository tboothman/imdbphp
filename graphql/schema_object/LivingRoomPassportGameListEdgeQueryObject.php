<?php

namespace GraphQL\SchemaObject;

class LivingRoomPassportGameListEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomPassportGameListEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(LivingRoomPassportGameListEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomPassportGameListQueryObject("node");
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

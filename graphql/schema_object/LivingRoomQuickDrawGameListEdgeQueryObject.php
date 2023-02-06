<?php

namespace GraphQL\SchemaObject;

class LivingRoomQuickDrawGameListEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomQuickDrawGameListEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(LivingRoomQuickDrawGameListEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomQuickDrawGameListQueryObject("node");
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

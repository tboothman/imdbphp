<?php

namespace GraphQL\SchemaObject;

class LivingRoomQuickDrawListConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomQuickDrawListConnection";

    public function selectEdges(LivingRoomQuickDrawListConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomQuickDrawGameListEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(LivingRoomQuickDrawListConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}

<?php

namespace GraphQL\SchemaObject;

class LivingRoomListGameTitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomListGameTitleConnection";

    public function selectEdges(LivingRoomListGameTitleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomListGameTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(LivingRoomListGameTitleConnectionPageInfoArgumentsObject $argsObject = null)
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

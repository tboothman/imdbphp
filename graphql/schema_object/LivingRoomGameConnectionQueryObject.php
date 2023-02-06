<?php

namespace GraphQL\SchemaObject;

class LivingRoomGameConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomGameConnection";

    public function selectEdges(LivingRoomGameConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(LivingRoomGameConnectionPageInfoArgumentsObject $argsObject = null)
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

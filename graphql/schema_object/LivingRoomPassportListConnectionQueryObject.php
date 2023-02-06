<?php

namespace GraphQL\SchemaObject;

class LivingRoomPassportListConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomPassportListConnection";

    public function selectEdges(LivingRoomPassportListConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomPassportGameListEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(LivingRoomPassportListConnectionPageInfoArgumentsObject $argsObject = null)
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

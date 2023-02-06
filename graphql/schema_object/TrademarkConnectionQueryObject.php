<?php

namespace GraphQL\SchemaObject;

class TrademarkConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrademarkConnection";

    public function selectEdges(TrademarkConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TrademarkEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TrademarkConnectionPageInfoArgumentsObject $argsObject = null)
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

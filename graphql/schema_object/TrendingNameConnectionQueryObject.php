<?php

namespace GraphQL\SchemaObject;

class TrendingNameConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingNameConnection";

    public function selectEdges(TrendingNameConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TrendingNameEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TrendingNameConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

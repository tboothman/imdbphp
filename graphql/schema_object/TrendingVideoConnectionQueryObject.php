<?php

namespace GraphQL\SchemaObject;

class TrendingVideoConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingVideoConnection";

    public function selectEdges(TrendingVideoConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TrendingVideoEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TrendingVideoConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

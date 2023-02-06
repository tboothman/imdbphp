<?php

namespace GraphQL\SchemaObject;

class TrendingTitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingTitleConnection";

    public function selectEdges(TrendingTitleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TrendingTitleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

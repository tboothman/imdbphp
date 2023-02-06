<?php

namespace GraphQL\SchemaObject;

class MoreLikeThisConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MoreLikeThisConnection";

    public function selectEdges(MoreLikeThisConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MoreLikeThisEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MoreLikeThisConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

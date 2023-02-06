<?php

namespace GraphQL\SchemaObject;

class NewsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NewsConnection";

    public function selectEdges(NewsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NewsEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NewsConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new NewsPageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(NewsConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new NewsRestrictionQueryObject("restriction");
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

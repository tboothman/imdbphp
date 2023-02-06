<?php

namespace GraphQL\SchemaObject;

class RecentlyViewedConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "RecentlyViewedConnection";

    public function selectEdges(RecentlyViewedConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new RecentlyViewedEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(RecentlyViewedConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRefTag(RecentlyViewedConnectionRefTagArgumentsObject $argsObject = null)
    {
        $object = new RefTagQueryObject("refTag");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

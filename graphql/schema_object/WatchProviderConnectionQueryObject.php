<?php

namespace GraphQL\SchemaObject;

class WatchProviderConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "WatchProviderConnection";

    public function selectEdges(WatchProviderConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new WatchProviderEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(WatchProviderConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

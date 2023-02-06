<?php

namespace GraphQL\SchemaObject;

class ListCollectionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListCollectionConnection";

    public function selectEdges(ListCollectionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ListCollectionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ListCollectionConnectionPageInfoArgumentsObject $argsObject = null)
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

<?php

namespace GraphQL\SchemaObject;

class ListConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListConnection";

    public function selectEdges(ListConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ListItemEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsPaginationDirty()
    {
        $this->selectField("isPaginationDirty");

        return $this;
    }

    public function selectJumpToFound()
    {
        $this->selectField("jumpToFound");

        return $this;
    }

    public function selectPageInfo(ListConnectionPageInfoArgumentsObject $argsObject = null)
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

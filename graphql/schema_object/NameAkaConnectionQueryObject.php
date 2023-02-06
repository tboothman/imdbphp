<?php

namespace GraphQL\SchemaObject;

class NameAkaConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameAkaConnection";

    public function selectEdges(NameAkaConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameAkaEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameAkaConnectionPageInfoArgumentsObject $argsObject = null)
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

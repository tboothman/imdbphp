<?php

namespace GraphQL\SchemaObject;

class NameRelationsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameRelationsConnection";

    public function selectEdges(NameRelationsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameRelationsEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameRelationsConnectionPageInfoArgumentsObject $argsObject = null)
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

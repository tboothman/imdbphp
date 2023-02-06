<?php

namespace GraphQL\SchemaObject;

class CrazyCreditConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CrazyCreditConnection";

    public function selectEdges(CrazyCreditConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CrazyCreditEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CrazyCreditConnectionPageInfoArgumentsObject $argsObject = null)
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

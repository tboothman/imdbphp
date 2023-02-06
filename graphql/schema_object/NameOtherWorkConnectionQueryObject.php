<?php

namespace GraphQL\SchemaObject;

class NameOtherWorkConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameOtherWorkConnection";

    public function selectEdges(NameOtherWorkConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameOtherWorkEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameOtherWorkConnectionPageInfoArgumentsObject $argsObject = null)
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

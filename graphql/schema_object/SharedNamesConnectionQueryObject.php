<?php

namespace GraphQL\SchemaObject;

class SharedNamesConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SharedNamesConnection";

    public function selectEdges(SharedNamesConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SharedNameEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SharedNamesConnectionPageInfoArgumentsObject $argsObject = null)
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

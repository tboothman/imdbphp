<?php

namespace GraphQL\SchemaObject;

class NameSearchConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameSearchConnection";

    public function selectEdges(NameSearchConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameSearchEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameSearchConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

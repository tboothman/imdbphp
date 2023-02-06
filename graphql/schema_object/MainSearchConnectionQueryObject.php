<?php

namespace GraphQL\SchemaObject;

class MainSearchConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MainSearchConnection";

    public function selectEdges(MainSearchConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MainSearchEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MainSearchConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

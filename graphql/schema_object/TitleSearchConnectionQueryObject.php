<?php

namespace GraphQL\SchemaObject;

class TitleSearchConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleSearchConnection";

    public function selectEdges(TitleSearchConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleSearchEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleSearchConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

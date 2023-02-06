<?php

namespace GraphQL\SchemaObject;

class StreamingTitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "StreamingTitleConnection";

    public function selectEdges(StreamingTitleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new StreamingTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(StreamingTitleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

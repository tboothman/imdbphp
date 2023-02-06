<?php

namespace GraphQL\SchemaObject;

class TrackedTitlesConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrackedTitlesConnection";

    public function selectEdges(TrackedTitlesConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TrackedTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TrackedTitlesConnectionPageInfoArgumentsObject $argsObject = null)
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

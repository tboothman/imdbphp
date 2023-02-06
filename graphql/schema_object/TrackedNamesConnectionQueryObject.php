<?php

namespace GraphQL\SchemaObject;

class TrackedNamesConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrackedNamesConnection";

    public function selectEdges(TrackedNamesConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TrackedNameEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TrackedNamesConnectionPageInfoArgumentsObject $argsObject = null)
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

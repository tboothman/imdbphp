<?php

namespace GraphQL\SchemaObject;

class AlternateVersionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlternateVersionConnection";

    public function selectEdges(AlternateVersionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AlternateVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AlternateVersionConnectionPageInfoArgumentsObject $argsObject = null)
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

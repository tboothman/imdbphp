<?php

namespace GraphQL\SchemaObject;

class ReleaseDateConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseDateConnection";

    public function selectEdges(ReleaseDateConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseDateEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ReleaseDateConnectionPageInfoArgumentsObject $argsObject = null)
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

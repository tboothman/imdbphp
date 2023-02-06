<?php

namespace GraphQL\SchemaObject;

class SharedTitlesConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SharedTitlesConnection";

    public function selectEdges(SharedTitlesConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SharedTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SharedTitlesConnectionPageInfoArgumentsObject $argsObject = null)
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

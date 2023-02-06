<?php

namespace GraphQL\SchemaObject;

class DisplayableYearConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableYearConnection";

    public function selectEdges(DisplayableYearConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableYearEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DisplayableYearConnectionPageInfoArgumentsObject $argsObject = null)
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

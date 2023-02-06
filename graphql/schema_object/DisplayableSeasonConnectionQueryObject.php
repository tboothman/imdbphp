<?php

namespace GraphQL\SchemaObject;

class DisplayableSeasonConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableSeasonConnection";

    public function selectEdges(DisplayableSeasonConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableSeasonEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DisplayableSeasonConnectionPageInfoArgumentsObject $argsObject = null)
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

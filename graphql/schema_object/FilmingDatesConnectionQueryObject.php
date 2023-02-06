<?php

namespace GraphQL\SchemaObject;

class FilmingDatesConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmingDatesConnection";

    public function selectEdges(FilmingDatesConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new FilmingDatesEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(FilmingDatesConnectionPageInfoArgumentsObject $argsObject = null)
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

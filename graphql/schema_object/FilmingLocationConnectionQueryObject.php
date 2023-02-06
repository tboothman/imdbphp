<?php

namespace GraphQL\SchemaObject;

class FilmingLocationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmingLocationConnection";

    public function selectEdges(FilmingLocationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new FilmingLocationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(FilmingLocationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(FilmingLocationConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new FilmingLocationRestrictionQueryObject("restriction");
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

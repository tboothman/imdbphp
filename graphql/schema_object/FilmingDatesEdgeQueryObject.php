<?php

namespace GraphQL\SchemaObject;

class FilmingDatesEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmingDatesEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(FilmingDatesEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new FilmingDatesQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }
}

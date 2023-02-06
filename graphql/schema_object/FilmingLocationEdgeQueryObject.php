<?php

namespace GraphQL\SchemaObject;

class FilmingLocationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmingLocationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(FilmingLocationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new FilmingLocationQueryObject("node");
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

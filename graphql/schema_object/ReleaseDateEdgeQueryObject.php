<?php

namespace GraphQL\SchemaObject;

class ReleaseDateEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseDateEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ReleaseDateEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ReleaseDateQueryObject("node");
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

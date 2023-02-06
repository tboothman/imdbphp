<?php

namespace GraphQL\SchemaObject;

class NameOtherWorkEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameOtherWorkEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameOtherWorkEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameOtherWorkQueryObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class ListItemEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListItemEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ListItemEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ListItemNodeQueryObject("node");
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

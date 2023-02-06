<?php

namespace GraphQL\SchemaObject;

class TopPicksEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TopPicksEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TopPicksEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("node");
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

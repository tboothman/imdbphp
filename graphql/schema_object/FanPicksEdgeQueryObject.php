<?php

namespace GraphQL\SchemaObject;

class FanPicksEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "FanPicksEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(FanPicksEdgeNodeArgumentsObject $argsObject = null)
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

<?php

namespace GraphQL\SchemaObject;

class CrazyCreditEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CrazyCreditEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CrazyCreditEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CrazyCreditQueryObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class AkaEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AkaEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AkaEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AkaQueryObject("node");
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

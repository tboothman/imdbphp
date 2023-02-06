<?php

namespace GraphQL\SchemaObject;

class NameAkaEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameAkaEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameAkaEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameAkaQueryObject("node");
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

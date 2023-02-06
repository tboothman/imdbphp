<?php

namespace GraphQL\SchemaObject;

class PollEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PollEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PollQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

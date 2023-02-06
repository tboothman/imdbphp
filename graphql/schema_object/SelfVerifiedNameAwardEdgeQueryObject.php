<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameAwardEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameAwardEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SelfVerifiedNameAwardEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAwardQueryObject("node");
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

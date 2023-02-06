<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameEducationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameEducationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SelfVerifiedNameEducationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameEducationQueryObject("node");
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

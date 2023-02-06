<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameReferenceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameReferenceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SelfVerifiedNameReferenceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameReferenceQueryObject("node");
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

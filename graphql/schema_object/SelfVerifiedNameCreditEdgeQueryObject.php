<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameCreditEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameCreditEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SelfVerifiedNameCreditEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditQueryObject("node");
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

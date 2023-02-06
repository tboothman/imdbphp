<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameTrainingEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameTrainingEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SelfVerifiedNameTrainingEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameTrainingQueryObject("node");
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

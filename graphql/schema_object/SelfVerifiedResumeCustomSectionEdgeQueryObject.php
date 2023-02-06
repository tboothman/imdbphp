<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedResumeCustomSectionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedResumeCustomSectionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SelfVerifiedResumeCustomSectionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedResumeCustomSectionQueryObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class PollAnswerEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollAnswerEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PollAnswerEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PollAnswerQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

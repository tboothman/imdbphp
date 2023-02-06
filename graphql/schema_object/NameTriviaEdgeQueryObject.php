<?php

namespace GraphQL\SchemaObject;

class NameTriviaEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameTriviaEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameTriviaEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameTriviaQueryObject("node");
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

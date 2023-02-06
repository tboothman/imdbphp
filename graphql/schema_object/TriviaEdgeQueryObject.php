<?php

namespace GraphQL\SchemaObject;

class TriviaEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TriviaEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TriviaEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleTriviaQueryObject("node");
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

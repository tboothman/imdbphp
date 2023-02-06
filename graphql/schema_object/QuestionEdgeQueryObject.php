<?php

namespace GraphQL\SchemaObject;

class QuestionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "QuestionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(QuestionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new QuestionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class GoofEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "GoofEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(GoofEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new GoofQueryObject("node");
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

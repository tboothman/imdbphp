<?php

namespace GraphQL\SchemaObject;

class RuntimeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RuntimeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RuntimeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RuntimeQueryObject("node");
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

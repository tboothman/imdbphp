<?php

namespace GraphQL\SchemaObject;

class MainSearchEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MainSearchEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MainSearchEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MainSearchNodeQueryObject("node");
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

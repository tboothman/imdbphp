<?php

namespace GraphQL\SchemaObject;

class NameSearchEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameSearchEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameSearchEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

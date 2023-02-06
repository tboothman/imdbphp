<?php

namespace GraphQL\SchemaObject;

class SharedNameEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SharedNameEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SharedNameEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SharedNameItemQueryObject("node");
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

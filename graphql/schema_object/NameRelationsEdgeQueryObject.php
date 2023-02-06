<?php

namespace GraphQL\SchemaObject;

class NameRelationsEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameRelationsEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameRelationsEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameRelationQueryObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class AlternateVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlternateVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AlternateVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AlternateVersionQueryObject("node");
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

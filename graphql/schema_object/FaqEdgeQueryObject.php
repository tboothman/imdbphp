<?php

namespace GraphQL\SchemaObject;

class FaqEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "FaqEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(FaqEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new FaqQueryObject("node");
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

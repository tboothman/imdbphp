<?php

namespace GraphQL\SchemaObject;

class NameQuoteEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameQuoteEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameQuoteEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameQuoteQueryObject("node");
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

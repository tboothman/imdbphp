<?php

namespace GraphQL\SchemaObject;

class TrademarkEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrademarkEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TrademarkEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TrademarkQueryObject("node");
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

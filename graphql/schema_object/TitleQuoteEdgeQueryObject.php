<?php

namespace GraphQL\SchemaObject;

class TitleQuoteEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleQuoteEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleQuoteEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQuoteQueryObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class TaglineEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TaglineEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TaglineEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TaglineQueryObject("node");
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

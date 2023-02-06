<?php

namespace GraphQL\SchemaObject;

class StreamingTitleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "StreamingTitleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(StreamingTitleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new StreamingTitleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

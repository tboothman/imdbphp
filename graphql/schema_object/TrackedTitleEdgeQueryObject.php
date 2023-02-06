<?php

namespace GraphQL\SchemaObject;

class TrackedTitleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrackedTitleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TrackedTitleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("node");
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

<?php

namespace GraphQL\SchemaObject;

class SoundtrackEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SoundtrackEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SoundtrackEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TrackQueryObject("node");
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

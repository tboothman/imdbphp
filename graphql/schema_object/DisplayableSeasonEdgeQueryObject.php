<?php

namespace GraphQL\SchemaObject;

class DisplayableSeasonEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableSeasonEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DisplayableSeasonEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableSeasonQueryObject("node");
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

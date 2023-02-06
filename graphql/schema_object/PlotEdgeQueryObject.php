<?php

namespace GraphQL\SchemaObject;

class PlotEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PlotEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PlotEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PlotQueryObject("node");
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

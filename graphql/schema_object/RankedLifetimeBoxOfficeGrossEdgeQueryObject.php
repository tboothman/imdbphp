<?php

namespace GraphQL\SchemaObject;

class RankedLifetimeBoxOfficeGrossEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RankedLifetimeBoxOfficeGrossEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RankedLifetimeBoxOfficeGrossEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RankedLifetimeBoxOfficeGrossQueryObject("node");
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

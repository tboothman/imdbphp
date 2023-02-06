<?php

namespace GraphQL\SchemaObject;

class CompanyCreditEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyCreditEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyCreditEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditQueryObject("node");
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

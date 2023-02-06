<?php

namespace GraphQL\SchemaObject;

class SalaryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SalaryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SalaryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SalaryQueryObject("node");
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

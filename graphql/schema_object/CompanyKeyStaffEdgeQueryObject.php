<?php

namespace GraphQL\SchemaObject;

class CompanyKeyStaffEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKeyStaffEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyKeyStaffEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CompanyKeyStaffQueryObject("node");
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

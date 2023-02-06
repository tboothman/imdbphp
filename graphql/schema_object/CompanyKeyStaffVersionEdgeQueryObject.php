<?php

namespace GraphQL\SchemaObject;

class CompanyKeyStaffVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKeyStaffVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyKeyStaffVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForKeyStaffVersionQueryObject("node");
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

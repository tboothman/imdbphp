<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForClientVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForClientVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyKnownForClientVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientVersionQueryObject("node");
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

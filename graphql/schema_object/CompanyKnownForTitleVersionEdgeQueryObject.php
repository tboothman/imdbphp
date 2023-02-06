<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForTitleVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForTitleVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyKnownForTitleVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleVersionQueryObject("node");
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

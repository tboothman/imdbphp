<?php

namespace GraphQL\SchemaObject;

class CompanyAffiliationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyAffiliationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyAffiliationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CompanyAffiliationQueryObject("node");
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

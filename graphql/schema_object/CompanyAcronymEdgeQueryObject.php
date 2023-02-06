<?php

namespace GraphQL\SchemaObject;

class CompanyAcronymEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyAcronymEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyAcronymEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CompanyAcronymQueryObject("node");
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

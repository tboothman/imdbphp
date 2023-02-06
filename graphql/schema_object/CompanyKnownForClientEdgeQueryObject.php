<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForClientEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForClientEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyKnownForClientEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientQueryObject("node");
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

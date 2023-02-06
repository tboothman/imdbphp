<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForTitleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForTitleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CompanyKnownForTitleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleQueryObject("node");
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

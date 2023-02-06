<?php

namespace GraphQL\SchemaObject;

class ContributorRankEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorRankEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ContributorRankEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ContributorRankQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardRankEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboardRankEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ContributorLeaderboardRankEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardRankQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

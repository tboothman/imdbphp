<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboardEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ContributorLeaderboardEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

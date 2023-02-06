<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardRankConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboardRankConnection";

    public function selectEdges(ContributorLeaderboardRankConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardRankEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ContributorLeaderboardRankConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

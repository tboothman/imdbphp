<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardRankQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboardRank";

    public function selectLeaderboard(ContributorLeaderboardRankLeaderboardArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardQueryObject("leaderboard");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRanking(ContributorLeaderboardRankRankingArgumentsObject $argsObject = null)
    {
        $object = new ContributorRankQueryObject("ranking");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboardConnection";

    public function selectEdges(ContributorLeaderboardConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ContributorLeaderboardConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

<?php

namespace GraphQL\SchemaObject;

class ContributorRankingsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorRankingsConnection";

    public function selectEdges(ContributorRankingsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ContributorRankEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ContributorRankingsConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}

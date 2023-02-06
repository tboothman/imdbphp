<?php

namespace GraphQL\SchemaObject;

class RatingsSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "RatingsSummary";

    public function selectAggregateRating()
    {
        $this->selectField("aggregateRating");

        return $this;
    }

    public function selectNotificationText(RatingsSummaryNotificationTextArgumentsObject $argsObject = null)
    {
        $object = new LocalizedMarkdownQueryObject("notificationText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopRanking(RatingsSummaryTopRankingArgumentsObject $argsObject = null)
    {
        $object = new TopRankingQueryObject("topRanking");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVoteCount()
    {
        $this->selectField("voteCount");

        return $this;
    }
}

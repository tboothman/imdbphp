<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboard";

    public function selectDescription(ContributorLeaderboardDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("description");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIsFinalized()
    {
        $this->selectField("isFinalized");

        return $this;
    }

    public function selectLastUpdated()
    {
        $this->selectField("lastUpdated");

        return $this;
    }

    public function selectLeaderboardUrl()
    {
        $this->selectField("leaderboardUrl");

        return $this;
    }

    public function selectMonth()
    {
        $this->selectField("month");

        return $this;
    }

    public function selectPeriod(ContributorLeaderboardPeriodArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardPeriodTypeQueryObject("period");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRankings(ContributorLeaderboardRankingsArgumentsObject $argsObject = null)
    {
        $object = new ContributorRankingsConnectionQueryObject("rankings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(ContributorLeaderboardTitleArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalApprovedItems()
    {
        $this->selectField("totalApprovedItems");

        return $this;
    }

    public function selectTotalContributors()
    {
        $this->selectField("totalContributors");

        return $this;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}
